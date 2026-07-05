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