---
name: rest-api-integration
description: Best practices for integrating REST APIs in frontend applications, including error handling, typesafety (Zod/TypeScript), authentication, and performance optimization. Use when implementing API clients, handling status codes, or structuring data synchronization layers.
---

# REST API Integration

This skill provides established patterns for integrating REST APIs effectively. It emphasizes typesafety, robust error handling, and performance.

## Core Principles

1. **Typesafety**: Always define response interfaces and validate them at the boundary (e.g., using Zod).
2. **Centralized Client**: Use a single configured instance (Axios/Fetch) to handle headers, baseURL, and interceptors.
3. **Graceful Error Handling**: Distinguish between network errors, validation errors, and server errors.
4. **Data Synchronization**: Synchronize UI state with server state using libraries like TanStack Query (React Query) when possible.

## Workflows

### 1. Basic API Client Setup

See [assets/client-template.ts](assets/client-template.ts) for a standard fetch-based client.

### 2. Error Handling

Follow the strategies in [references/error-handling.md](references/error-handling.md) to manage status codes and network failures.

### 3. Typesafety and Validation

Use the patterns in [references/typesafety.md](references/typesafety.md) to ensure data integrity.

## Best Practices

- **Avoid Ad-hoc Fetching**: Do not call `fetch` directly in components. Use hooks or a dedicated data layer.
- **Request Cancellation**: Implement AbortController for cleanups.
- **Loading States**: Always handle loading and empty states explicitly in the UI.
