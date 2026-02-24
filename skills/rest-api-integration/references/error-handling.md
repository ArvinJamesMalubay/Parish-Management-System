# Error Handling in REST APIs

Effective error handling requires distinguishing between different types of failures and providing clear feedback to the UI.

## 1. Network Errors

Errors that occur before the request reaches the server (e.g., DNS failure, timeout).

- **Strategy**: Implement retries for idempotent requests (GET, PUT, DELETE). Show an "Offline" or "Network Error" message.

## 2. HTTP Status Codes

Handle responses based on standard categories:

- **2xx (Success)**: Proceed with data.
- **400 (Bad Request)**: Usually validation errors. Map these to form field errors.
- **401 (Unauthorized)**: Trigger re-authentication or logout flow.
- **403 (Forbidden)**: Inform the user they lack permissions.
- **404 (Not Found)**: Show a specific "Not Found" state rather than a generic error.
- **5xx (Server Error)**: Log and show a "Something went wrong" message.

## 3. Standardized Error Object

Ensure your API client returns a consistent error shape:

```typescript
interface ApiError {
  message: string;
  code?: string;
  details?: Record<string, string[]>; // For validation errors
  status: number;
}
```

## 4. Retries and Backoff

For transient failures (503, connection reset), use exponential backoff:

- Attempt 1: 500ms
- Attempt 2: 1000ms
- Attempt 3: 2000ms

## 5. UI Notification Patterns

- **Blocking**: Error pages / Modals (for critical failures).
- **Non-blocking**: Toasts / Snackbars (for background sync failures).
- **Inline**: Dynamic error messages next to inputs (for validation).
