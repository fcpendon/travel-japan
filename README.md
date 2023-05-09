# Travel: Japan

Tara is a simple travel SPA designed to provide API-based weather forecasts via [openweathermap.org](https://openweathermap.org/forecast5), and API-based location searches via [foursquare.com](https://location.foursquare.com/developer/reference/place-search).

Tech Stack:
- Laravel
- Vue.js
- Vite

## Dev Notes

The user picks a city from a list of hand-picked cities available. The city's basic information is provided, as well as a 5-day weather forecast. Search feature is useful for locating nearby establishments, but most results have addresses which are in Japanese. A loading message is also shown when fetching data, and automatically scrolls to the results once received. Overall, UI/IX is responsive, mobile-friendly, user-friendly, and convenient.

Backend code implementation applies PSR-1, PSR-12, and SOLID. I used the Service Pattern, Form Request validation, and PHP's type-hinting to enforce data integrity. Frontend code implementation uses Single File Components and axios to communicate with the backend server.

## Project Setup
### 1. Prepare .env and fill API keys
```sh
cp .env.example .env

# Provide FOURSQUARE_API_KEY and OPENWEATHERMAP_API_KEY
```

### 2. Install backend dependencies
```sh
composer install
```

### 3. Install frontend dependencies
```sh
npm install
```

### 4. Start backend server
```sh
php artisan serve
```

### 5. Start frontend server
```sh
npm run dev
```
