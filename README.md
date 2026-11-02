# eatsongbrew

This project is set up for a Vercel static deployment.

What was changed:
- the ZIP archive remains in the repo root
- Vercel now unzips `htdocs (1).zip` during build
- the app is served from the extracted `htdocs/` folder

Deployment notes:
- Use the repo as a static project in Vercel
- The project root is the repo root
- `vercel.json` is configured to unzip the site and publish `htdocs/`
