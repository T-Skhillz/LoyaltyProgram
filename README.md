# Loyalty Program API

A backend system for a loyalty program where customers unlock achievements and earn badges for their purchases. After every unlocked badge, a cashback payment of 300 naira is rewarded.

---

## Tech Stack

- **Framework:** Laravel (PHP)
- **Database:** PostgreSQL (production), SQLite (testing)
- **Authentication:** Laravel Sanctum
- **Testing:** Pest

---

## Setup Instructions

```bash
# 1. Clone the repository
git clone https://github.com/T-Skhillz/LoyaltyProgram.git
cd LoyaltyProgram

# 2. Install dependencies
composer install

# 3. Configure environment
cp .env.example .env
php artisan key:generate

# 4. Update .env with your database credentials
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=loyalty_program
DB_USERNAME=your_username
DB_PASSWORD=your_password

# 5. Run migrations and seed the database
php artisan migrate --seed

# 6. Serve the application
php artisan serve
```

---

## API Endpoints

All endpoints except `register` and `login` require a `Bearer` token in the `Authorization` header.

```
POST      /api/v1/register
POST      /api/v1/login
POST      /api/v1/logout
GET|HEAD  /api/v1/user
POST      /api/v1/purchases
GET|HEAD  /api/v1/users/{user}/achievements
```

---

### POST /api/v1/register

**Request:**
```json
{
    "full_name": "Red Hood",
    "username": "red",
    "email": "red@gmail.com",
    "password": "1234test",
    "password_confirmation": "1234test"
}
```

**Response `201`:**
```json
{
    "user": {
        "full_name": "Red Hood",
        "username": "red",
        "email": "red@gmail.com",
        "id": "019dbf83-8b38-717a-85ff-e79c77c4e340",
        "updated_at": "2026-04-25T14:35:37.000000Z",
        "created_at": "2026-04-24T12:42:42.000000Z"
    },
    "access_token": "your_token_here",
    "token_type": "Bearer"
}
```

---

### POST /api/v1/login

**Request:**
```json
{
    "username": "red",
    "password": "1234test"
}
```

**Response `200`:**
```json
{
    "access_token": "your_token_here",
    "token_type": "Bearer"
}
```

---

### POST /api/v1/logout

**Response `200`:**
```json
{
    "message": "Logged out successfully"
}
```

---

### GET /api/v1/user

**Response `200`:**
```json
{
    "id": "019dbf83-8b38-717a-85ff-e79c77c4e340",
    "full_name": "Red Hood",
    "username": "red",
    "email": "red@gmail.com",
    "current_points": 1050,
    "total_amount_spent": "50000.00",
    "total_purchase_count": 5,
    "created_at": "2026-04-24T12:42:42.000000Z",
    "updated_at": "2026-04-25T14:35:37.000000Z"
}
```

---

### POST /api/v1/purchases

**Request:**
```json
{
    "amount": 1234
}
```

**Response `201`:**
```json
{
    "message": "Purchase completed successfully."
}
```

---

### GET /api/v1/users/{user}/achievements

**Response `200`:**
```json
{
    "data": {
        "achievements": {
            "unlocked_achievements": [
                {
                    "id": "019dbf83-13fc-72e5-af3d-ef3e608edc84",
                    "name": "Whale",
                    "type": "amount_spent",
                    "points_awarded": 1000,
                    "threshold": 25000,
                    "created_at": "2026-04-24T12:42:11.000000Z",
                    "updated_at": "2026-04-24T12:42:11.000000Z"
                },
                {
                    "id": "019dbf83-13ff-7047-b305-602d08474849",
                    "name": "Loyal Supporter",
                    "type": "amount_spent",
                    "points_awarded": 50,
                    "threshold": 1000,
                    "created_at": "2026-04-24T12:42:11.000000Z",
                    "updated_at": "2026-04-24T12:42:11.000000Z"
                }
            ],
            "next_available_achievements": [
                {
                    "id": "019dbf83-12b9-7036-a3ae-6b153499f78a",
                    "name": "Early Bird",
                    "type": "purchases_count",
                    "points_awarded": 10,
                    "threshold": 1,
                    "created_at": "2026-04-24T12:42:11.000000Z",
                    "updated_at": "2026-04-24T12:42:11.000000Z"
                },
                {
                    "id": "019dbf83-13fd-7127-8d82-183a91b97f30",
                    "name": "Bronze Spender",
                    "type": "purchases_count",
                    "points_awarded": 50,
                    "threshold": 10,
                    "created_at": "2026-04-24T12:42:11.000000Z",
                    "updated_at": "2026-04-24T12:42:11.000000Z"
                },
                {
                    "id": "019dbf83-13fa-7332-9644-ec0ca9f7820b",
                    "name": "Power User",
                    "type": "purchases_count",
                    "points_awarded": 250,
                    "threshold": 50,
                    "created_at": "2026-04-24T12:42:11.000000Z",
                    "updated_at": "2026-04-24T12:42:11.000000Z"
                }
            ]
        },
        "badges": {
            "current_badge": {
                "id": "019dbf83-12c6-7236-8446-b432a3e8711b",
                "name": "Loyal Customer",
                "points_required": 1000,
                "created_at": "2026-04-24T12:42:11.000000Z",
                "updated_at": "2026-04-24T12:42:11.000000Z"
            },
            "next_badge": {
                "id": "019dbf83-1532-7004-8f18-764736fe027f",
                "name": "Elite Member",
                "points_required": 2000,
                "created_at": "2026-04-24T12:42:12.000000Z",
                "updated_at": "2026-04-24T12:42:12.000000Z"
            },
            "remaining_to_unlock_next_badge": 950
        },
        "meta": {
            "generated_at": "2026-04-25T15:03:26+00:00"
        }
    }
}
```

---

## Running Tests

```bash
php artisan test
```