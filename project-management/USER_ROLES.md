# Epilepsy Support Platform (ESP)

# User Roles

Version: v0.2.0-alpha

---

# Philosophy

The platform uses Role-Based Access Control (RBAC).

Every authenticated user is assigned one primary role.

Permissions are granted through roles rather than directly to users.

Future versions may support multiple roles per user.

---

# Roles

## Visitor

Unauthenticated user.

Permissions:

- View public pages
- Read articles
- View events
- Contact the organization

---

## Member

Individual living with epilepsy.

Permissions:

- Personal dashboard
- Profile management
- Seizure diary
- Medication tracker
- Appointment calendar
- Emergency card
- Reports
- Community participation

---

## Caregiver

Trusted individual assisting one or more members.

Permissions:

- View shared member information (with consent)
- Medication overview
- Appointment reminders
- Emergency contacts
- Notifications

---

## Healthcare Professional

Doctor, nurse, specialist, or clinician.

Permissions:

- Professional resources
- Shared patient reports (with consent)
- Clinical tools
- Educational materials

---

## Moderator

Community management.

Permissions:

- Moderate forums
- Review reported posts
- Manage community discussions
- Remove inappropriate content

---

## Editor

Content management.

Permissions:

- Articles
- Categories
- Pages
- Downloads
- Media Library
- Events

---

## Administrator

System administration.

Permissions:

- Users
- Roles
- Reports
- Settings
- Media
- Forums
- Audit Logs
- Site Configuration

---

## Super Administrator (Reserved)

Platform owner.

Permissions:

Everything.

This role is reserved for future multi-organization support and will not be used in the initial release.