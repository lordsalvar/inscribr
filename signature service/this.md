Runs an API server (FastAPI/Flask).

Laravel sends POST requests here when it needs AI layout or signature placement.

Example endpoint: /api/signature/place.

Communication Flow

Laravel uploads a PDF and stores it.

Laravel sends a REST request to your Python service:

text
POST http://localhost:8000/api/signature/place
Body: { "pdf_url": "...", "signers": [...] }
Python analyzes and edits the PDF.

Python replies with JSON containing the new signed document location or URL.

You Run Both Apps Separately:

Laravel runs on port 8001 (or your default localhost port).

Python FastAPI runs on port 8000.