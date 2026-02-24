# Typesafety in REST API Integrations

Ensuring that data from the API matches your expectations at runtime and build time.

## 1. Response Interfaces

Always define the shape of your data using TypeScript interfaces.

```typescript
export interface User {
  id: string;
  email: string;
  name: string;
}

export interface ApiCollection<T> {
  data: T[];
  meta: {
    total: number;
    page: number;
  };
}
```

## 2. Validation at the Boundary (Zod)

Define Zod schemas to validate incoming data. This catches API regressions before they cause obscure frontend crashes.

```typescript
import { z } from "zod";

export const UserSchema = z.object({
  id: z.string(),
  email: z.string().email(),
  name: z.string().min(1),
});

export type User = z.infer<typeof UserSchema>;
```

## 3. Generic API Methods

Use generics in your client to preserve types.

```typescript
async get<T>(url: string, schema?: z.ZodSchema<T>): Promise<T> {
  const response = await fetch(url);
  const data = await response.json();

  if (schema) {
    return schema.parse(data);
  }

  return data as T;
}
```

## 4. Derived Types

Use `Pick`, `Omit`, and `Partial` to create specialized types for requests (e.g., `CreateUserDto`).

```typescript
export type CreateUserDto = Omit<User, "id">;
export type UpdateUserDto = Partial<CreateUserDto>;
```

## 5. DTO vs Domain Models

If the API structure is inconvenient for the UI, transform it in the API layer.

- **DTO**: Data Transfer Object (exact API response).
- **Model**: UI-optimized structure.
- **Mapper**: Function that transforms DTO -> Model.
