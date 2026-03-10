Here’s an updated **README.md** that reflects the new dynamic recommendation system, where the AI driver can be swapped (Gemini, OpenAI, Claude, etc.) via configuration:

```markdown
# SmartShop Mini

A mini e‑commerce demo built with Laravel.  
Features include product browsing, AI‑powered recommendations (via configurable drivers), and a simple cart system.
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

# AI driver selection
RECOMMENDATION_DRIVER=gemini

# API keys for drivers
GEMINI_API_KEY=your_gemini_api_key_here
```

- `USER_EMAIL`, `USER_NAME`, `USER_PASSWORD` → used to seed the default admin user.
- `RECOMMENDATION_DRIVER` → choose which AI provider to use (`gemini`, `openai`, `claude`).
- API keys → set the key for the driver you selected.

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

Visit `http://localhost:8000` in your browser.

---

## Features
- Product listing & detail pages
- Session‑based cart
- AI recommendation system (dynamic driver selection)

---

## AI Recommendations
- The app tracks the last 3 products a user views and sends them to the configured AI driver with the full product list.
- The driver suggests 3 similar products, which are displayed in the **Recommended for you** section.
- If the API fails, random products are shown instead.

### Dynamic Driver System
- Drivers are defined in `config/recommendation.php`:
  ```php
  'drivers' => [
      'gemini' => \App\Services\Drivers\GeminiDriver::class,
      //'openai' => \App\Services\Drivers\OpenAIDriver::class,
      //'claude' => \App\Services\Drivers\ClaudeDriver::class,
  ],
  ```
- Switch providers by changing `.env`:
  ```env
  RECOMMENDATION_DRIVER=openai
  ```
- Add new drivers by implementing the `RecommendationDriver` interface.

---

## 📌 Notes
- For local WAMP/XAMPP development, you may need to bypass SSL verification (`verify => false`) in the Http client.
- In production, configure CA certificates properly and remove the bypass.

