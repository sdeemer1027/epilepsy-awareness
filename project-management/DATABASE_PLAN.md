# Epilepsy Support Platform (ESP)

# Database Plan

**Version:** v0.2.0-alpha

---

# Purpose

This document defines the database architecture for the Epilepsy Support Platform (ESP).

The purpose of this document is to design the database before implementation, ensuring that every table, relationship, and migration has a defined purpose.

This document serves as the master database reference for the project and will evolve alongside the application.

---

# Database Design Philosophy

The database will follow these principles:

- Design before implementation.
- Normalize data whenever practical.
- Minimize duplicated information.
- Enforce relationships using foreign keys.
- Keep authentication separate from medical information.
- Support future expansion without major redesign.
- Maintain compatibility with Laravel Eloquent ORM.
- Document every table before creating its migration.

---

# Database Modules

The database is divided into functional modules.

Each module will be documented separately before implementation.

## Module 1 – Security & Identity

Responsible for authentication, authorization, and auditing.

Planned tables:

- users
- roles
- permissions
- role_permissions
- user_permissions
- audit_logs
- password_reset_tokens
- sessions

---

## Module 2 – Member Profiles

Stores personal profile information separate from authentication.

Planned tables:

- profiles
- addresses
- emergency_contacts
- caregivers
- member_caregivers
- physicians
- member_physicians

---

## Module 3 – Medical Management

Core medical records and seizure tracking.

Planned tables:

- seizures
- seizure_types
- seizure_triggers
- medications
- medication_logs
- seizure_medications
- allergies
- diagnoses
- appointments
- medical_documents

---

## Module 4 – Content Management

Website content management.

Planned tables:

- pages
- articles
- categories
- tags
- article_tag
- media
- downloads
- faqs

---

## Module 5 – Community

Community interaction and communication.

Planned tables:

- forums
- topics
- posts
- comments
- reactions
- private_messages
- notifications

---

## Module 6 – Events

Community events and registrations.

Planned tables:

- events
- event_categories
- event_registrations

---

## Module 7 – Administration

System configuration and administration.

Planned tables:

- settings
- activity_logs
- contact_messages
- system_notifications

---

# Database Standards

The following standards will be used throughout the project.

## Table Naming

- Plural
- snake_case

Examples:

- users
- seizure_types
- medical_documents

---

## Foreign Keys

Foreign keys will follow Laravel conventions.

Examples:

- user_id
- role_id
- article_id

---

## Pivot Tables

Pivot tables will use singular model names in alphabetical order.

Examples:

- article_tag
- member_caregiver
- role_permission

---

## Timestamps

Laravel timestamps will be used whenever appropriate.

- created_at
- updated_at

---

## Soft Deletes

Tables that store user-created content or medical records should generally support soft deletes.

Examples include:

- articles
- pages
- seizures
- medications

---

# Migration Strategy

No migration should be created until the corresponding table has been fully documented.

Each table specification will include:

- Purpose
- Columns
- Data types
- Relationships
- Indexes
- Validation requirements
- Future considerations

---

# Development Sequence

The database will be implemented in the following order:

1. Security & Identity
2. Member Profiles
3. Medical Management
4. Content Management
5. Community
6. Events
7. Administration

Each module will be completed and verified before moving to the next.

---

# Related Documents

This document works together with:

- ARCHITECTURE.md
- USER_ROLES.md
- FEATURES.md
- CODING_STANDARDS.md
- PROJECT_RULES.md

---

# Revision History

| Version | Description |
|----------|-------------|
| v0.2.0-alpha | Initial database architecture created. |

---

# Module 1 – Security & Identity

## Overview

This module is responsible for authentication, authorization, identity management, and auditing.

It provides the foundation for every other module in the platform.

No other module may exist without this one.

---

# Table: users

## Purpose

Stores authentication credentials and basic account information.

Medical, profile, and contact information will not be stored here. Those belong in the `profiles` table.

### Planned Columns

| Column | Type | Required | Notes |
|---------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| role_id | bigint | Yes | Foreign key to roles |
| name | string(255) | Yes | Display name |
| email | string(255) | Yes | Unique |
| email_verified_at | timestamp | No | Laravel default |
| password | string | Yes | Hashed password |
| remember_token | string | No | Laravel default |
| is_active | boolean | Yes | Default true |
| last_login_at | timestamp | No | Last successful login |
| created_at | timestamp | Yes | Laravel default |
| updated_at | timestamp | Yes | Laravel default |

### Relationships

- belongsTo Role
- hasOne Profile
- hasMany Audit Logs
- hasMany Notifications

### Notes

The `users` table should remain focused on authentication and account status.

---

# Table: roles

## Purpose

Defines user roles used by the Role-Based Access Control (RBAC) system.

### Planned Columns

| Column | Type | Required | Notes |
|---------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| name | string | Yes | Display name |
| slug | string | Yes | Unique |
| description | text | No | Role description |
| created_at | timestamp | Yes | Laravel default |
| updated_at | timestamp | Yes | Laravel default |

### Relationships

- hasMany Users
- belongsToMany Permissions

---

# Table: permissions

## Purpose

Defines individual permissions that may be assigned to roles.

### Example Permissions

- manage_users
- manage_articles
- manage_events
- moderate_forums
- manage_settings
- edit_profile
- view_reports

### Relationships

- belongsToMany Roles

---

# Table: role_permissions

## Purpose

Pivot table connecting roles to permissions.

### Relationships

- belongsTo Role
- belongsTo Permission

---

# Table: user_permissions

## Purpose

Reserved for future permission overrides on individual users.

This table will not be implemented in Version 1.0 but is included in the blueprint for future expansion.

---

# Table: audit_logs

## Purpose

Records important system activity for security and troubleshooting.

### Example Events

- User login
- User logout
- Password reset
- Profile update
- Role assignment
- Permission change
- Content deletion

### Planned Columns

| Column | Type | Notes |
|---------|------|-------|
| id | bigint | Primary Key |
| user_id | bigint | Nullable if system event |
| event | string | Event identifier |
| description | text | Human-readable summary |
| ip_address | string | IPv4/IPv6 |
| user_agent | text | Browser/device information |
| created_at | timestamp | Event timestamp |

### Relationships

- belongsTo User

---

# Module Status

**Status:** Draft

Implementation will begin only after the module has been reviewed and approved.

