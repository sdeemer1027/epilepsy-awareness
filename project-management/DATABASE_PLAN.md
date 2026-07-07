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

---

# Module 2 – Member Domain

## Overview

The Member Domain manages personal, non-authentication information for users of the platform.

This includes:

- Personal profile data
- Emergency contacts
- Caregiver relationships
- Physician relationships

This module is separate from authentication to ensure clean separation between identity and personal/medical data.

---

# Table: profiles

## Purpose

Stores personal information for each user.

This table extends the `users` table with demographic and optional health-related metadata.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| user_id | bigint | Yes | FK → users |
| first_name | string | Yes | |
| last_name | string | Yes | |
| date_of_birth | date | No | |
| phone_number | string | No | |
| address_line_1 | string | No | |
| address_line_2 | string | No | |
| city | string | No | |
| state_province | string | No | |
| postal_code | string | No | |
| country | string | No | |
| preferred_language | string | No | Default en |
| emergency_contact_name | string | No | Quick access field |
| emergency_contact_phone | string | No | Quick access field |
| avatar | string | No | Profile image path |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- belongsTo User
- hasMany Emergency Contacts
- hasMany Caregiver Links
- hasMany Physician Links

---

## Notes

Address fields are stored directly in this table for simplicity at this stage.

Future versions may normalize addresses into a separate table if needed.

---

# Table: emergency_contacts

## Purpose

Stores emergency contact information for a member.

A member may have multiple emergency contacts.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| user_id | bigint | Yes | FK → users |
| name | string | Yes | Contact name |
| relationship | string | No | e.g. Parent, Spouse |
| phone_primary | string | Yes | |
| phone_secondary | string | No | |
| email | string | No | |
| priority | integer | No | Lower = higher priority |
| is_primary | boolean | Yes | Default false |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- belongsTo User

---

# Table: caregivers

## Purpose

Stores caregiver accounts linked to members.

Caregivers may assist one or multiple members.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| user_id | bigint | Yes | FK → users (caregiver) |
| notes | text | No | Optional caregiver notes |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- belongsTo User
- belongsToMany Users (members via pivot)

---

# Table: member_caregivers

## Purpose

Pivot table linking members to caregivers.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| member_id | bigint | Yes | FK → users |
| caregiver_id | bigint | Yes | FK → users |
| relationship_type | string | No | e.g. Parent, Friend |
| permissions | json | No | Future granular access control |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- belongsTo User (member)
- belongsTo User (caregiver)

---

# Table: physicians

## Purpose

Stores healthcare professional accounts linked to members.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| name | string | Yes | |
| specialty | string | No | Neurologist, GP, etc |
| phone | string | No | |
| email | string | No | |
| clinic_name | string | No | |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- belongsToMany Users (members via pivot)

---

# Table: member_physicians

## Purpose

Links members to physicians.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| member_id | bigint | Yes | FK → users |
| physician_id | bigint | Yes | FK → physicians |
| primary | boolean | No | Indicates main doctor |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- belongsTo User
- belongsTo Physician

---

# Module Status

**Status:** Draft

This module will be reviewed before migration creation begins.

---

# Module 3 – Medical Domain

## Overview

The Medical Domain manages all health-related tracking for users living with epilepsy.

This includes seizure tracking, medication management, appointments, diagnoses, triggers, allergies, and supporting medical documentation.

This module is designed to support personal health management and communication with caregivers and healthcare professionals.

It is NOT a replacement for a hospital Electronic Health Record (EHR) system.

---

# Table: seizures

## Purpose

Stores recorded seizure events for a user.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| user_id | bigint | Yes | FK → users |
| seizure_type_id | bigint | No | FK → seizure_types |
| start_time | timestamp | Yes | |
| end_time | timestamp | No | |
| duration_seconds | integer | No | Calculated or stored |
| location | string | No | Where event occurred |
| trigger_id | bigint | No | FK → seizure_triggers |
| notes | text | No | User notes |
| severity | integer | No | Scale 1–10 |
| was_witnessed | boolean | Yes | Default false |
| witnessed_by | string | No | |
| postictal_state | text | No | Recovery description |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- belongsTo User
- belongsTo Seizure Type
- belongsTo Seizure Trigger
- hasMany Seizure Medications (if administered during event)

---

# Table: seizure_types

## Purpose

Defines categories of seizures.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| name | string | Yes | e.g. Focal, Generalized |
| description | text | No | |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

# Table: seizure_triggers

## Purpose

Stores known or user-defined seizure triggers.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| name | string | Yes | e.g. Stress, Sleep deprivation |
| description | text | No | |
| is_common | boolean | Yes | Default false |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

# Table: medications

## Purpose

Stores medication definitions available to users.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| name | string | Yes | Medication name |
| generic_name | string | No | |
| dosage_form | string | No | Tablet, Liquid, etc |
| strength | string | No | e.g. 500mg |
| description | text | No | |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

# Table: medication_logs

## Purpose

Tracks medication intake events for users.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| user_id | bigint | Yes | FK → users |
| medication_id | bigint | Yes | FK → medications |
| dosage | string | No | Actual dose taken |
| taken_at | timestamp | Yes | |
| scheduled_at | timestamp | No | Planned time |
| status | string | Yes | taken, missed, skipped |
| notes | text | No | |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

# Table: seizure_medications

## Purpose

Tracks medication administered during or after a seizure event.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| seizure_id | bigint | Yes | FK → seizures |
| medication_id | bigint | Yes | FK → medications |
| dosage | string | No | |
| administered_by | string | No | Caregiver or paramedic |
| notes | text | No | |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

# Table: allergies

## Purpose

Stores user allergy information.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| user_id | bigint | Yes | FK → users |
| allergen | string | Yes | Substance name |
| reaction | text | No | Description |
| severity | string | No | mild, moderate, severe |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

# Table: diagnoses

## Purpose

Stores medical diagnoses for users.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| user_id | bigint | Yes | FK → users |
| condition | string | Yes | e.g. Epilepsy |
| diagnosed_at | date | No | |
| notes | text | No | |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

# Table: appointments

## Purpose

Stores medical appointments.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| user_id | bigint | Yes | FK → users |
| physician_id | bigint | No | FK → physicians |
| title | string | Yes | |
| description | text | No | |
| scheduled_at | timestamp | Yes | |
| location | string | No | |
| status | string | Yes | scheduled, completed, cancelled |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

# Table: medical_documents

## Purpose

Stores uploaded medical files.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| user_id | bigint | Yes | FK → users |
| title | string | Yes | |
| file_path | string | Yes | Storage path |
| file_type | string | No | PDF, image, etc |
| description | text | No | |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

# Module Status

**Status:** Draft

This module will be reviewed carefully before migration creation due to its complexity and importance.

---

# Module 4 – Content Management Domain

## Overview

The Content Management Domain handles all public-facing and administrative content within the platform.

This includes informational pages, articles, categories, tags, media uploads, downloads, and frequently asked questions.

This module powers the public website and future CMS functionality.

---

# Table: pages

## Purpose

Stores static or semi-static website pages such as About, Privacy Policy, and Terms of Service.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| title | string | Yes | Page title |
| slug | string | Yes | URL identifier |
| content | longText | Yes | Page HTML/Markdown content |
| status | string | Yes | draft, published |
| published_at | timestamp | No | |
| created_by | bigint | No | FK → users |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- belongsTo User (creator)

---

# Table: articles

## Purpose

Stores blog-style or informational articles.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| title | string | Yes | |
| slug | string | Yes | |
| excerpt | text | No | Short summary |
| content | longText | Yes | Full article |
| category_id | bigint | No | FK → categories |
| status | string | Yes | draft, published |
| published_at | timestamp | No | |
| author_id | bigint | Yes | FK → users |
| views | integer | No | Default 0 |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- belongsTo User (author)
- belongsTo Category
- belongsToMany Tags

---

# Table: categories

## Purpose

Groups articles and other content into logical sections.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| name | string | Yes | |
| slug | string | Yes | |
| description | text | No | |
| type | string | No | article, page, event |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- hasMany Articles

---

# Table: tags

## Purpose

Provides flexible labeling for articles and other content.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| name | string | Yes | |
| slug | string | Yes | |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- belongsToMany Articles

---

# Table: article_tag

## Purpose

Pivot table linking articles and tags.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| article_id | bigint | Yes | FK → articles |
| tag_id | bigint | Yes | FK → tags |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

# Table: media

## Purpose

Stores uploaded files such as images, documents, and attachments.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| user_id | bigint | Yes | FK → users |
| file_name | string | Yes | Original file name |
| file_path | string | Yes | Storage location |
| file_type | string | No | image, pdf, video |
| mime_type | string | No | |
| size | integer | No | File size in bytes |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- belongsTo User

---

# Table: downloads

## Purpose

Stores downloadable resources such as PDFs, guides, and educational material.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| title | string | Yes | |
| description | text | No | |
| file_path | string | Yes | |
| file_type | string | No | |
| category_id | bigint | No | FK → categories |
| created_by | bigint | No | FK → users |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- belongsTo User (creator)
- belongsTo Category

---

# Table: faqs

## Purpose

Stores frequently asked questions for the public website.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| question | string | Yes | |
| answer | text | Yes | |
| category | string | No | optional grouping |
| order | integer | No | display order |
| is_published | boolean | Yes | Default true |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

# Module Status

**Status:** Draft

This module will be reviewed before implementation begins.

---

# Module 5 – Community Domain

## Overview

The Community Domain provides communication and peer support features for the Epilepsy Support Platform.

The goal is to create a safe, moderated environment where members, caregivers, healthcare professionals, and administrators can share experiences, ask questions, and support one another.

All community content should be subject to moderation and auditing.

---

# Table: forums

## Purpose

Defines the top-level discussion areas.

Examples:

- Newly Diagnosed
- Living with Epilepsy
- Parents & Caregivers
- Medications
- Research
- General Discussion

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| title | string | Yes | |
| slug | string | Yes | Unique |
| description | text | No | |
| display_order | integer | Yes | Default 0 |
| is_private | boolean | Yes | Default false |
| is_active | boolean | Yes | Default true |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- hasMany Topics

---

# Table: topics

## Purpose

Represents discussion threads within a forum.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| forum_id | bigint | Yes | FK → forums |
| user_id | bigint | Yes | FK → users |
| title | string | Yes | |
| is_pinned | boolean | Yes | Default false |
| is_locked | boolean | Yes | Default false |
| views | integer | Yes | Default 0 |
| last_post_at | timestamp | No | |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- belongsTo Forum
- belongsTo User
- hasMany Posts

---

# Table: posts

## Purpose

Stores individual posts within a topic.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| topic_id | bigint | Yes | FK → topics |
| user_id | bigint | Yes | FK → users |
| content | longText | Yes | |
| edited_at | timestamp | No | |
| edited_by | bigint | No | FK → users |
| is_hidden | boolean | Yes | Default false |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- belongsTo Topic
- belongsTo User
- hasMany Comments
- hasMany Reactions

---

# Table: comments

## Purpose

Stores comments on posts.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| post_id | bigint | Yes | FK → posts |
| user_id | bigint | Yes | FK → users |
| content | text | Yes | |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- belongsTo Post
- belongsTo User

---

# Table: reactions

## Purpose

Stores user reactions to posts.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| post_id | bigint | Yes | FK → posts |
| user_id | bigint | Yes | FK → users |
| reaction | string | Yes | like, support, thanks, etc. |
| created_at | timestamp | Yes | |

---

## Relationships

- belongsTo Post
- belongsTo User

---

# Table: private_messages

## Purpose

Supports direct messaging between authorized users.

Future versions may expand this into conversations or group messaging.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| sender_id | bigint | Yes | FK → users |
| recipient_id | bigint | Yes | FK → users |
| subject | string | No | |
| message | longText | Yes | |
| read_at | timestamp | No | |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- belongsTo User (sender)
- belongsTo User (recipient)

---

# Table: notifications

## Purpose

Stores notifications delivered to users.

Notifications may be generated by:

- System events
- Community activity
- Medication reminders
- Appointment reminders
- Caregiver updates

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| user_id | bigint | Yes | FK → users |
| type | string | Yes | Notification type |
| title | string | Yes | |
| message | text | Yes | |
| link | string | No | Optional URL |
| read_at | timestamp | No | |
| created_at | timestamp | Yes | |

---

## Relationships

- belongsTo User

---

# Moderation Considerations

Community content should support:

- Reporting inappropriate content
- Moderator review
- Content hiding
- Audit logging
- Future automated moderation tools

These capabilities may require additional tables in future versions.

---

# Module Status

**Status:** Draft

Community functionality will be implemented after the Content Management module has been completed and reviewed.

---

# Module 6 – Events Domain

## Overview

The Events Domain manages educational, awareness, fundraising, and community events hosted by the Epilepsy Support Platform or partner organizations.

The design supports both virtual and in-person events and is structured to accommodate future enhancements such as recurring events, attendance tracking, certificates of participation, and calendar synchronization.

---

# Table: event_categories

## Purpose

Defines categories used to organize events.

Examples include:

- Webinar
- Support Group
- Fundraiser
- Conference
- Awareness Campaign
- Training Session

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| name | string | Yes | |
| slug | string | Yes | Unique |
| description | text | No | |
| color | string | No | UI display color |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- hasMany Events

---

# Table: events

## Purpose

Stores event information.

Events may be public, members-only, caregiver-only, healthcare professional events, or administrative events.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| category_id | bigint | No | FK → event_categories |
| title | string | Yes | |
| slug | string | Yes | Unique |
| description | longText | Yes | |
| event_type | string | Yes | Virtual, In Person, Hybrid |
| start_datetime | timestamp | Yes | |
| end_datetime | timestamp | No | |
| timezone | string | Yes | Default UTC |
| location | string | No | Physical location |
| meeting_url | string | No | Virtual meeting link |
| capacity | integer | No | Maximum attendees |
| registration_required | boolean | Yes | Default true |
| is_public | boolean | Yes | Default true |
| status | string | Yes | Draft, Published, Cancelled, Completed |
| organizer_user_id | bigint | No | FK → users |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- belongsTo Event Category
- belongsTo User (Organizer)
- hasMany Event Registrations

---

# Table: event_registrations

## Purpose

Tracks user registrations for events.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| event_id | bigint | Yes | FK → events |
| user_id | bigint | Yes | FK → users |
| registered_at | timestamp | Yes | |
| attendance_status | string | Yes | Registered, Attended, Cancelled, No Show |
| check_in_at | timestamp | No | |
| notes | text | No | |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- belongsTo Event
- belongsTo User

---

# Future Enhancements

Future versions may support:

- Recurring events
- Multi-session conferences
- Waitlists
- Calendar integration (Google, Outlook, Apple)
- QR code check-in
- Attendance certificates
- Speaker profiles
- Event sponsors
- Continuing education credits

---

# Module Status

**Status:** Draft

The Events Domain will be implemented after the Community Domain has been completed and approved.

---

# Module 7 – Administration Domain

## Overview

The Administration Domain provides the operational tools required to manage, monitor, and maintain the Epilepsy Support Platform (ESP).

These tables support system configuration, auditing, user feedback, announcements, and operational monitoring. They are intended for administrative users and system processes.

---

# Table: settings

## Purpose

Stores configurable system settings that can be managed without modifying application code.

Examples include:

- Site name
- Organization information
- Email configuration
- Registration settings
- Feature toggles
- Maintenance mode
- Theme options

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| key | string | Yes | Unique configuration key |
| value | longText | No | Stored value |
| data_type | string | Yes | string, boolean, integer, json |
| category | string | No | General grouping |
| description | text | No | Administrator notes |
| updated_by_user_id | bigint | No | FK → users |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- belongsTo User (updated by)

---

# Table: contact_messages

## Purpose

Stores messages submitted through the public contact form.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| name | string | Yes | |
| email | string | Yes | |
| subject | string | Yes | |
| message | longText | Yes | |
| status | string | Yes | New, In Progress, Closed |
| assigned_to_user_id | bigint | No | FK → users |
| responded_at | timestamp | No | |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- belongsTo User (assigned administrator)

---

# Table: activity_logs

## Purpose

Stores operational events generated throughout the application.

Unlike audit logs, activity logs are intended primarily for system monitoring.

Examples:

- Scheduled job completed
- Email sent
- Backup completed
- Cache cleared
- Import completed

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| level | string | Yes | info, warning, error |
| source | string | Yes | Module or service |
| event | string | Yes | Event name |
| description | text | No | |
| metadata | json | No | Additional structured data |
| created_at | timestamp | Yes | |

---

# Table: announcements

## Purpose

Stores announcements displayed to selected audiences.

Examples:

- Scheduled maintenance
- New feature releases
- Awareness campaigns
- Emergency notifications

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| title | string | Yes | |
| message | longText | Yes | |
| audience | string | Yes | Public, Members, Caregivers, Healthcare, Admin |
| priority | string | Yes | Low, Normal, High, Critical |
| starts_at | timestamp | No | |
| ends_at | timestamp | No | |
| is_active | boolean | Yes | Default true |
| created_by_user_id | bigint | Yes | FK → users |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- belongsTo User (creator)

---

# Table: feature_flags

## Purpose

Allows features to be enabled or disabled without deploying new code.

This table is optional for Version 1.0 but included for future scalability.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| name | string | Yes | Unique feature name |
| description | text | No | |
| enabled | boolean | Yes | Default false |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

# Table: maintenance_windows

## Purpose

Defines scheduled maintenance periods.

Future versions may automatically display maintenance banners or disable specific services during these windows.

---

## Planned Columns

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| id | bigint | Yes | Primary Key |
| title | string | Yes | |
| description | text | No | |
| starts_at | timestamp | Yes | |
| ends_at | timestamp | Yes | |
| created_by_user_id | bigint | Yes | FK → users |
| created_at | timestamp | Yes | |
| updated_at | timestamp | Yes | |

---

## Relationships

- belongsTo User (creator)

---

# Administrative Principles

The Administration Domain follows these principles:

- Every important administrative action should be traceable.
- Configuration should be stored in the database whenever practical.
- Operational logs should support troubleshooting.
- Sensitive administrative actions should also be recorded

