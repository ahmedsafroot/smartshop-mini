Here’s the full **README.md** written entirely in Markdown, ready to drop into your repo:

```markdown
# SmartShop Mini

A mini e‑commerce demo built with Laravel.  
Features include product browsing, AI‑powered recommendations (via Gemini API), and a simple cart system.
```
---

## 🚀 Getting Started

### 1. Clone the repository
```bash
git clone https://github.com/ahmedsafroot/smartshop-mini.git
cd smartshop-mini
```

### 2. Install dependencies
```bash
composer install
npm install && npm run dev
```

### 3. Environment setup
Copy `.env.example` to `.env`:
```bash
cp .env.example .env
```

Update the following keys in `.env`:

```env
USER_EMAIL=your_admin_email@example.com
USER_NAME=your_admin_name
USER_PASSWORD=your_admin_password
GEMINI_API_KEY=your_api_key_here
```

- `USER_EMAIL`, `USER_NAME`, `USER_PASSWORD` → used to seed the default admin user.
- `GEMINI_API_KEY` → your Gemini API key from [Google AI Studio](https://aistudio.google.com).

### 4. Generate app key
```bash
php artisan key:generate
```

### 5. Run migrations & seed
```bash
php artisan migrate --seed
```

### 6. Start the server
```bash
php artisan serve
```

Visit `http://localhost:8000` [(localhost in Bing)](https://www.bing.com/search?q="http%3A%2F%2Flocalhost%3A8000%2F") in your browser.

---

## Features
- Product listing & detail pages
- Session‑based cart
- AI recommendation system (Gemini API)

---

## AI Recommendations
The app tracks the last 3 products a user views and sends them to Gemini with the full product list.  
Gemini suggests 3 similar products, which are displayed in the **Recommended for you** section.  
If the API fails, random products are shown instead.

---

## 📌 Notes
- For local WAMP/XAMPP development, you may need to bypass SSL verification (`verify => false`) in the Http client.
- In production, configure CA certificates properly and remove the bypass.



