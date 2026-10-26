body {
  margin: 0;
  font-family: Arial, sans-serif;
  background: #f7f3ef;
  color: #1f1f1f;
}

* { box-sizing: border-box; }

.container {
  width: min(1100px, 90vw);
  margin: 0 auto;
}

.topbar {
  background: #2d221b;
  color: #fff;
  padding: 16px 0;
}

.nav {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.brand {
  font-size: 1.5rem;
  font-weight: 700;
}

nav {
  display: flex;
  gap: 18px;
  align-items: center;
}

nav a {
  color: #f5ede6;
  text-decoration: none;
}

.hero {
  background: linear-gradient(135deg, #f5d7a0, #f4efe9);
  min-height: 260px;
  display: flex;
  align-items: center;
  padding: 40px 0;
  margin: 32px 0;
  border-radius: 16px;
}

.hero h1 {
  font-size: clamp(2.2rem, 4vw, 4rem);
  margin: 8px 0 16px;
}

.eyebrow {
  text-transform: uppercase;
  letter-spacing: 0.14em;
  font-size: 0.75rem;
  color: #685748;
}

.grid {
  display: grid;
  gap: 18px;
}

.grid.three {
  grid-template-columns: repeat(3, minmax(0, 1fr));
}

.card {
  background: #fff;
  border-radius: 14px;
  padding: 22px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.04);
  margin-bottom: 24px;
}

.order-box {
  margin-top: 24px;
}

.form-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 18px;
}

label {
  display: block;
  font-weight: 600;
  margin-bottom: 14px;
}

input, select, textarea, button {
  width: 100%;
  padding: 12px 14px;
  border: 1px solid #d4c6b8;
  border-radius: 10px;
  font-size: 1rem;
  margin-top: 8px;
}

button, .button {
  display: inline-block;
  border: none;
  cursor: pointer;
  text-decoration: none;
  text-align: center;
  transition: 0.2s ease;
}

.button.primary {
  background: #8c4b34;
  color: #fff;
  padding: 12px 18px;
  border-radius: 10px;
}

.auth-shell {
  display: grid;
  place-items: center;
  min-height: 70vh;
}

.form-card {
  width: min(500px, 90vw);
}

.alert {
  padding: 10px 12px;
  border-radius: 8px;
  margin: 12px 0;
}

.alert.error {
  background: #fee7e7;
  color: #8f1d1d;
}

.alert.success {
  background: #e9f9ee;
  color: #1f6b44;
}

.hidden {
  display: none !important;
}

.order-list {
  list-style: none;
  padding: 0;
  margin: 0;
  display: grid;
  gap: 10px;
}

.order-list li {
  display: flex;
  justify-content: space-between;
  gap: 12px;
  background: #f9f7f4;
  border-radius: 8px;
  padding: 12px 14px;
}

.footer {
  text-align: center;
  padding: 24px;
  color: #6d625d;
}

@media (max-width: 768px) {
  .grid.three, .form-grid {
    grid-template-columns: 1fr;
  }
  .nav {
    flex-direction: column;
    gap: 10px;
  }
}
