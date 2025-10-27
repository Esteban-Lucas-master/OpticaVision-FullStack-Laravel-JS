# Project Architecture Documentation

## Overview

This document describes the improved architecture of the Optica Vision Laravel application. The new structure follows modern best practices for Laravel applications, including separation of concerns, role-based organization, and service layer implementation.

## Directory Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   ├── DashboardController.php
│   │   │   ├── ProductController.php
│   │   │   ├── PurchaseController.php
│   │   │   └── UsuarioController.php
│   │   ├── Seller/
│   │   │   ├── DashboardController.php
│   │   │   ├── ProductController.php
│   │   │   └── PurchaseController.php
│   │   ├── Client/
│   │   │   ├── ProductController.php
│   │   │   └── PurchaseController.php
│   │   ├── BaseController.php
│   │   ├── ProfileController.php
│   ├── Middleware/
│   │   └── RoleMiddleware.php
├── Models/
│   ├── Product.php
│   ├── ProductHistory.php
│   ├── ProductImage.php
│   ├── Purchase.php
│   └── User.php
├── Services/
│   ├── ProductService.php
│   ├── PurchaseService.php
│   └── UserService.php
├── Providers/
│   └── AppServiceProvider.php
routes/
├── web.php
├── api.php
└── auth.php
resources/
├── views/
│   ├── admin/
│   │   ├── dashboard.blade.php
│   │   ├── products/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── edit.blade.php
│   │   │   └── history.blade.php
│   │   ├── purchases/
│   │   │   └── history.blade.php
│   │   └── usuarios.blade.php
│   ├── seller/
│   │   ├── historial.blade.php
│   ├── client/
│   ├── auth/
│   ├── components/
│   ├── layouts/
│   ├── pdf/
│   ├── profile/
│   ├── show.blade.php
│   └── welcome.blade.php
```

## Key Architectural Improvements

### 1. Role-Based Controller Organization

Controllers are now organized by user roles:
- **Admin**: Controllers for administrative functions
- **Seller**: Controllers for seller-specific operations
- **Client**: Controllers for client-facing functionality

This organization makes it easier to understand which parts of the application handle which user roles.

### 2. Service Layer Implementation

A service layer has been introduced to encapsulate business logic:
- **ProductService**: Handles product-related operations
- **PurchaseService**: Manages purchase workflows
- **UserService**: Manages user operations

Benefits:
- Separation of business logic from controllers
- Improved testability
- Code reusability across controllers
- Better maintainability

### 3. Base Controller

A BaseController extends Laravel's default Controller and provides common functionality:
- Standardized response methods
- Consistent error handling
- Shared utility functions

### 4. Improved Route Organization

Routes are now organized by user roles with clear naming conventions:
- Admin routes prefixed with `/admin`
- Seller routes prefixed with `/seller`
- Client routes at the root level

### 5. Dependency Injection

Services are injected into controllers via constructor injection, following Laravel best practices:
- Improved testability
- Better decoupling
- Clearer dependencies

## Role-Based Access Control

The application uses a role-based access control system:
- **Admin**: Full access to all system features
- **Seller**: Manage own products and process purchases
- **Client**: Browse products and make purchases

## API Design

The application follows RESTful principles where applicable:
- Clear resource-based URLs
- Standard HTTP methods
- Consistent response formats

## Security Considerations

- Role verification at both route and controller levels
- Proper authorization checks before sensitive operations
- Input validation and sanitization
- CSRF protection for forms

## Extensibility

The new architecture makes it easier to:
- Add new roles and permissions
- Extend existing functionality
- Integrate with external services
- Add new features without disrupting existing code

## Testing Strategy

The service layer makes unit testing easier:
- Business logic can be tested independently of HTTP requests
- Services can be mocked in controller tests
- Integration tests can verify end-to-end workflows

## Deployment Considerations

- Clear separation of concerns simplifies debugging
- Service layer makes it easier to identify performance bottlenecks
- Role-based organization helps with feature flagging