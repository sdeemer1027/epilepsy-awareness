# Document Information

**Project:** Epilepsy Support Platform (ESP)

**Document:** Development Foundation Standards

**Version:** 1.0.0-alpha

**Status:** Approved for Implementation

**Last Updated:** July 7, 2026

------------------------------------------------------------------------

# Purpose

This document defines the implementation standards that will be used for
all future ESP development.

The goal is to keep the codebase consistent, maintainable, testable, and
easy for future contributors to understand.

------------------------------------------------------------------------

# Core Implementation Principles

Every feature should follow these principles:

-   Build vertically by feature.
-   Keep controllers thin.
-   Put validation in Form Requests.
-   Use Policies for authorization.
-   Keep business logic out of Blade views.
-   Write tests for critical workflows.
-   Update documentation alongside code.
-   Prefer Laravel conventions unless a documented reason exists to
    deviate.

------------------------------------------------------------------------

# File Organization

Laravel's standard directory structure should be preserved, but
implementation work should be planned and tracked by feature.

``` text
project-management/features/

MemberProfile/
    FEATURE.md
    DATABASE.md
    UI.md
    API.md
    TESTS.md
```

Code implementation should remain in Laravel's normal directories unless
a future ADR approves a different structure.

------------------------------------------------------------------------

# Controller Pattern

-   Accept validated Form Requests.
-   Keep controllers thin.
-   Delegate complex business logic to services.
-   Return views, redirects, or API responses.

------------------------------------------------------------------------

# Form Request Pattern

Validation belongs in dedicated Form Request classes.

Examples:

-   StoreProfileRequest
-   UpdateProfileRequest
-   StoreSeizureRequest
-   UpdateMedicationRequest

Each request should define:

-   Authorization
-   Validation rules
-   Custom messages (when appropriate)

------------------------------------------------------------------------

# Policy Pattern

Use Laravel Policies for authorization.

Policies should enforce:

-   Ownership
-   Role permissions
-   Caregiver/member relationships
-   Healthcare access rules

------------------------------------------------------------------------

# Service Layer Pattern

Place reusable or complex business logic into services.

Examples:

-   SeizureService
-   MedicationService
-   NotificationService
-   EventRegistrationService

------------------------------------------------------------------------

# Model Standards

Models should:

-   Define fillable attributes.
-   Define relationships.
-   Use casts where appropriate.
-   Avoid presentation logic.

------------------------------------------------------------------------

# Route Standards

-   Use named routes.
-   Group by middleware.
-   Prefer resource controllers where appropriate.

------------------------------------------------------------------------

# View Standards

Blade views should:

-   Extend shared layouts.
-   Use reusable components.
-   Minimize logic.
-   Follow UI standards.
-   Be accessible.

------------------------------------------------------------------------

# Testing Standards

Every critical feature should include:

-   Feature tests
-   Policy tests
-   Validation tests
-   Database relationship tests

------------------------------------------------------------------------

# Documentation Standards

Every feature should update:

-   PROJECT_TRACKER.md
-   Relevant feature documentation
-   README.md (when installation or usage changes)

------------------------------------------------------------------------

# Git Workflow

1.  Create a feature branch.
2.  Implement one vertical slice.
3.  Run tests.
4.  Update documentation.
5.  Commit with a clear message.
6.  Open for review.

------------------------------------------------------------------------

# Definition of Done

A feature is complete only when:

-   Database changes completed (if applicable)
-   Models completed
-   Controllers completed
-   Requests completed
-   Policies completed
-   Routes completed
-   Views completed
-   Tests passing
-   Documentation updated
-   Accessibility reviewed
-   Security reviewed
-   Task marked as Verified in PROJECT_TRACKER.md

------------------------------------------------------------------------

# Revision History

  Version       Description
  ------------- ------------------------------------------
  1.0.0-alpha   Initial development foundation standards

  