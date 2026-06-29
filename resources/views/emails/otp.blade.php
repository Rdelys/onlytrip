{{-- resources/views/emails/otp.blade.php --}}
<div style="font-family: Arial, sans-serif; text-align:center; padding:30px;">
    <h2>🌍 OnlyTrip</h2>
    <p>Votre code de vérification est :</p>
    <h1 style="letter-spacing: 10px;">{{ $otp }}</h1>
    <p>Ce code est valable pendant 10 minutes.</p>
</div>