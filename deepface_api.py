"""
deepface_api.py  –  OnlyTrip gender detection microservice
Run: pip install deepface fastapi uvicorn python-multipart
Then: uvicorn deepface_api:app --host 0.0.0.0 --port 8001
"""

import base64
import io
import os
import tempfile

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
    Response: { "dominant_gender": "Man" | "Woman", "confidence": float }
    """
    try:
        from deepface import DeepFace  # imported lazily so startup is fast when unused

        img_bytes = base64.b64decode(payload.image_b64)

        with tempfile.NamedTemporaryFile(suffix=".jpg", delete=False) as tmp:
            tmp.write(img_bytes)
            tmp_path = tmp.name

        try:
            result = DeepFace.analyze(
                img_path=tmp_path,
                actions=["gender"],
                enforce_detection=False,    # don't crash if face is at an angle
                silent=True,
            )

            if isinstance(result, list):
                result = result[0]

            gender_dict = result.get("gender", {})
            dominant = max(gender_dict, key=gender_dict.get)  # "Man" or "Woman"
            confidence = gender_dict.get(dominant, 0)

            return {"dominant_gender": dominant, "confidence": round(confidence, 2)}

        finally:
            os.unlink(tmp_path)

    except Exception as exc:
        return {"dominant_gender": None, "error": str(exc)}


@app.get("/health")
async def health():
    return {"status": "ok"}