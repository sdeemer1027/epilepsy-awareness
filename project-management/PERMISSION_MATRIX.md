# Document Information

**Project:** Epilepsy Support Platform (ESP)

**Document:** Permission Matrix

**Version:** 0.2.0-alpha

**Status:** Draft

**Last Updated:** July 7, 2026

---

# Purpose

This document defines which user roles may access each feature within the platform.

Authorization should always follow the principle of **least privilege**.

Users should only have access to the information and functionality required to perform their role.

---

# User Roles

| Role | Description |
|-------|-------------|
| Guest | Public visitor |
| Member | Person living with epilepsy |
| Caregiver | Authorized caregiver |
| Healthcare Professional | Authorized healthcare provider |
| Editor | Content manager |
| Administrator | Full system administrator |

---

# Legend

| Symbol | Meaning |
|--------|---------|
| ✅ | Full access |
| 👁 | View only |
| ➕ | Create |
| ✏ | Edit |
| ❌ | No access |
| * | Conditional access |

---

# Public Website

| Feature | Guest | Member | Caregiver | Healthcare | Editor | Admin |
|---------|:-----:|:------:|:---------:|:----------:|:------:|:-----:|
| View Public Pages | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| Search Articles | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| Download Public Resources | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| Contact Form | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |

---

# Medical Features

| Feature | Guest | Member | Caregiver | Healthcare | Editor | Admin |
|---------|:-----:|:------:|:---------:|:----------:|:------:|:-----:|
| View Own Medical Profile | ❌ | ✅ | ❌ | ❌ | ❌ | ✅ |
| Record Seizure | ❌ | ✅ | ✅* | ❌ | ❌ | ✅ |
| Log Medication | ❌ | ✅ | ✅* | ❌ | ❌ | ✅ |
| View Shared Reports | ❌ | ❌ | ✅* | ✅* | ❌ | ✅ |
| Upload Medical Documents | ❌ | ✅ | ✅* | ❌ | ❌ | ✅ |

---

# Community

| Feature | Guest | Member | Caregiver | Healthcare | Editor | Admin |
|---------|:-----:|:------:|:---------:|:----------:|:------:|:-----:|
| View Forums | 👁 | 👁 | 👁 | 👁 | ✅ | ✅ |
| Create Topics | ❌ | ➕ | ➕ | ➕ | ✅ | ✅ |
| Reply to Topics | ❌ | ➕ | ➕ | ➕ | ✅ | ✅ |
| Moderate Content | ❌ | ❌ | ❌ | ❌ | ✅ | ✅ |

---

# Content Management

| Feature | Guest | Member | Caregiver | Healthcare | Editor | Admin |
|---------|:-----:|:------:|:---------:|:----------:|:------:|:-----:|
| Create Articles | ❌ | ❌ | ❌ | ❌ | ✅ | ✅ |
| Publish Articles | ❌ | ❌ | ❌ | ❌ | ✅ | ✅ |
| Manage Pages | ❌ | ❌ | ❌ | ❌ | ✅ | ✅ |

---

# Administration

| Feature         | Guest | Member | Caregiver | Healthcare | Editor | Admin |
|---------        |:-----:|:------:|:---------:|:----------:|:------:|:-----:|
| User Management | ❌   | ❌     | ❌        | ❌        | ❌    | ✅    |
| Role Management | ❌   | ❌     | ❌        | ❌        | ❌    | ✅    |
| System Settings | ❌   | ❌     | ❌        | ❌        | ❌    | ✅    |
| View Audit Logs | ❌   | ❌     | ❌        | ❌        | ❌    | ✅    |

---

# Conditional Access

Entries marked with **\*** require an approved relationship between the member and the caregiver or healthcare professional.

Authorization should be enforced through Laravel Policies.

---

# Revision History

| Version | Description |
|----------|-------------|
| 0.2.0-alpha | Initial permission matrix |

