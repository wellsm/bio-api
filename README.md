# Bio API

A modern bio link management API built with [Hyperf](https://hyperf.io) framework. This application allows users to create and manage their bio pages with links, social media profiles, and customizable configurations.

## ✨ Features

- 👤 **User Management** - Registration, authentication, and profiles
- 🔗 **Link Management** - Create, organize, and track link clicks
- 📱 **Social Media Integration** - Connect various social platforms
- 📚 **Collections** - Group links into organized collections
- 🎨 **Customizable Themes** - Multiple layouts and styling options
- 📊 **Analytics** - Track interactions and engagement
- 🔧 **Configuration System** - Flexible settings per profile

## 🚀 Quick Start

#### Prerequisites

- **Docker** and **Docker Compose** (required)

#### 1. Clone the Repository

```bash
git clone https://github.com/wellsm/bio-web.git
cd bio-api
```

#### 2. Environment Configuration

Create your environment file:

```bash
cp .env.example .env
```

Edit `.env` with your settings:

```bash
APP_NAME=bio
APP_KEY=base64:dzJkdzY1eWQxZGRmbGdtbnhwdzhscTJuYmZ5MWxiOGw=
APP_ENV=local

CORS_ALLOWED_ORIGINS=*

DB_DRIVER=mysql
DB_HOST=bio-mysql
DB_PORT=3306
DB_DATABASE=bio
DB_USERNAME=root
DB_PASSWORD=root
DB_CHARSET=utf8mb4
DB_COLLATION=utf8mb4_unicode_ci
DB_PREFIX=

REDIS_HOST=cache
REDIS_AUTH=(null)
REDIS_PORT=6379
REDIS_DB=0

SMTP_HOST=email
SMTP_AUTH=(false)
SMTP_USERNAME=dev@bio.com
SMTP_PASSWORD=
SMTP_ENCRYPTION=
SMTP_PORT=1025

SHLINK_ENABLED=false
SHLINK_API_KEY=
SHLINK_BASE_URI=
```

#### 3. Start with Docker (Recommended)

```bash
# Build and start containers
docker compose up -d

# Check containers are running
docker compose ps
```

The application will be available at:
- **API**: http://localhost:7010

#### 4. Database Setup

Run migrations:

```bash
docker compose exec bio-php php bin/hyperf.php migrate --seed
```

This creates sample data:
- **User**: John Doe (`john@example.com`) - Developer profile
- **Password**: `123456`
- **Links**: Personal blog, portfolio, resume
- **Social Media**: Instagram, Twitter, LinkedIn, GitHub

## 🛠️ Development

### Available Commands

```bash
# Install dependencies
docker compose exec bio-php composer install

# Run migrations
docker compose exec bio-php php bin/hyperf.php migrate

# Code style check
docker compose exec bio-php vendor/bin/php-cs-fixer fix

# Static analysis
docker compose exec bio-php vendor/bin/phpstan analyze
```

### Project Structure

```
bio-api/
├── app/
│   ├── Application/         # Application layer
│   │   ├── Command/         # Console commands
│   │   ├── Http/           # Controllers, Middleware, Requests
│   │   └── Service/        # Business logic services
│   ├── Core/               # Core domain logic
│   │   ├── Entities/       # Domain entities
│   │   ├── Repositories/   # Repository interfaces
│   │   └── ValueObjects/   # Value objects
│   ├── Infrastructure/     # Infrastructure layer
│   │   └── Repositories/   # Repository implementations
│   └── Model/              # Eloquent models
├── config/                 # Configuration files
├── migrations/             # Database migrations
├── seeders/               # Database seeders
├── public/                # Public assets and documentation
├── storage/               # Logs, cache, uploads
└── docker/                # Docker configuration
```

## 🔗 API Documentation

Once the application is running, visit:
- **Swagger UI**: http://localhost:7010/api/documentation
- **API Spec**: `public/documentation/api.yml`

## 📊 Database

### Connection

- **Host**: localhost (external), bio-mysql (internal)
- **Port**: 7011 (external), 3306 (internal)
- **Database**: bio
- **Username**: root
- **Password**: root

### Sample Data

The seeder creates:
- 1 complete user profile (John Doe)
- 3 sample links
- 4 social media connections  
- Custom configuration settings

## 🐳 Docker Services

### bio-php
- **Image**: Custom PHP 8.1+ with Swoole
- **Port**: 7010:9501
- **Purpose**: Main application server

### bio-mysql
- **Image**: Custom MySQL 8.0
- **Port**: 7011:3306
- **Purpose**: Database server
- **Data**: Persisted in `bio-mysql-data` volume

## 🛠️ Local Development (Without Docker)

### Requirements

- PHP 8.1+
- Swoole extension >= 5.0
- MySQL 8.0+
- Composer

### Setup

```bash
# Install dependencies
composer install

# Start development server
php bin/hyperf.php start

# Or watch for changes
composer watch
```

## 🚨 Troubleshooting

### Common Issues

**1. Port already in use**
```bash
# Check what's using the port
lsof -i :7010

# Change port in compose.yml or .env
```

**2. Database connection failed**
```bash
# Check MySQL is running
docker compose ps bio-mysql

# Check logs
docker compose logs bio-mysql
```

**3. Permission issues**
```bash
# Fix storage permissions
chmod -R 755 storage/
```

**4. Swoole not installed**
```bash
# Install Swoole (local development)
pecl install swoole
```

### Logs

Check application logs:
```bash
# View PHP logs
docker compose logs bio-php

# View MySQL logs
docker compose logs bio-mysql

# Follow logs in real-time
docker compose logs -f
```

## 📝 Environment Variables

| Variable | Default | Description |
|----------|---------|-------------|
| `APP_ENV` | `local` | Application environment |
| `APP_DEBUG` | `true` | Debug mode |
| `PORT` | `9501` | Server port |
| `DB_HOST` | `bio-mysql` | Database host |
| `DB_DATABASE` | `bio` | Database name |
| `DB_USERNAME` | `root` | Database user |
| `DB_PASSWORD` | `root` | Database password |

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Run tests and linting
5. Submit a pull request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

- **Documentation**: Check the `public/documentation` directory
- **Issues**: Create a GitHub issue
- **API Docs**: Visit `/api/documentation` endpoint when running

---

**Happy coding!** 🎉
