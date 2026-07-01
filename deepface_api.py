"""
deepface_api.py  –  OnlyTrip gender detection microservice
Run: pip install deepface fastapi uvicorn python-multipart tf-keras
Then: uvicorn deepface_api:app --host 0.0.0.0 --port 8001
"""

import base64
import os
import tempfile
import traceback

from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel

app = FastAPI(title="OnlyTrip DeepFace API")

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],   # lock to your Laravel domain in production
    allow_methods=["POST"],
    allow_headers=["*"],
)


class ImagePayload(BaseModel):
    image_b64: str          # base64-encoded image (JPEG/PNG)


@app.post("/analyze")
async def analyze(payload: ImagePayload):
    """
    Accepts a base64 image and returns the dominant detected gender.
    Success response : { "dominant_gender": "Man" | "Woman", "confidence": float }
    Failure response  : { "dominant_gender": null, "error": "<reason>" }
    """
    tmp_path = None
    try:
        from deepface import DeepFace

        try:
            img_bytes = base64.b64decode(payload.image_b64)
        except Exception as exc:
            return {"dominant_gender": None, "error": f"Image base64 invalide: {exc}"}

        if len(img_bytes) < 100:
            return {"dominant_gender": None, "error": "Image vide ou trop petite après décodage."}

        with tempfile.NamedTemporaryFile(suffix=".jpg", delete=False) as tmp:
            tmp.write(img_bytes)
            tmp_path = tmp.name

        try:
            result = DeepFace.analyze(
                img_path=tmp_path,
                actions=["gender"],
                enforce_detection=True,
                silent=True,
            )
        except ValueError:
            return {
                "dominant_gender": None,
                "error": "Aucun visage détecté dans l'image. Rapprochez-vous de la caméra, "
                         "assurez un bon éclairage et regardez l'objectif.",
            }

        if isinstance(result, list):
            if len(result) == 0:
                return {"dominant_gender": None, "error": "Aucun visage trouvé (liste vide)."}
            result = result[0]

        gender_dict = result.get("gender")

        if not gender_dict or not isinstance(gender_dict, dict) or len(gender_dict) == 0:
            return {
                "dominant_gender": None,
                "error": "Réponse DeepFace inattendue, pas de scores de genre disponibles.",
            }

        # ── Conversion stricte vers types Python natifs ──────────────────
        # DeepFace/numpy renvoie souvent des numpy.float32 et numpy.str_,
        # que FastAPI/Pydantic ne sait pas sérialiser directement en JSON.
        # On force explicitement str() et float() sur chaque valeur.
        gender_dict_native = {str(k): float(v) for k, v in gender_dict.items()}

        dominant_raw = max(gender_dict_native, key=gender_dict_native.get)
        dominant = str(dominant_raw)
        confidence = float(gender_dict_native[dominant_raw])

        return {
            "dominant_gender": dominant,
            "confidence": round(confidence, 2),
        }

    except Exception as exc:
        return {
            "dominant_gender": None,
            "error": f"Erreur interne: {exc}",
            "trace": traceback.format_exc()[-1500:],
        }
    finally:
        if tmp_path and os.path.exists(tmp_path):
            os.unlink(tmp_path)


@app.get("/health")
async def health():
    return {"status": "ok"}