/**
 * Standard API Client Boilerplate
 * A robust fetch wrapper with error handling and request/response interceptor logic.
 */

export type ApiMethod = "GET" | "POST" | "PUT" | "PATCH" | "DELETE";

export interface ApiRequestOptions {
  method?: ApiMethod;
  headers?: Record<string, string>;
  body?: any;
  params?: Record<string, string | number | boolean | undefined>;
  cache?: RequestCache;
  signal?: AbortSignal;
}

export class ApiError extends Error {
  constructor(
    public status: number,
    public message: string,
    public data?: any,
  ) {
    super(message);
    this.name = "ApiError";
  }
}

const BASE_URL = process.env.NEXT_PUBLIC_API_URL || "";

/**
 * Core Request Function
 */
export async function apiRequest<T>(
  endpoint: string,
  options: ApiRequestOptions = {},
): Promise<T> {
  const { method = "GET", headers = {}, body, params, signal } = options;

  // 1. Build URL with Search Params
  const url = new URL(endpoint, BASE_URL);
  if (params) {
    Object.entries(params).forEach(([key, value]) => {
      if (value !== undefined) url.searchParams.append(key, String(value));
    });
  }

  // 2. Prepare Headers
  const requestHeaders = new Headers({
    "Content-Type": "application/json",
    ...headers,
  });

  // 3. Inject Auth Token (Example)
  const token =
    typeof window !== "undefined" ? localStorage.getItem("token") : null;
  if (token) {
    requestHeaders.set("Authorization", `Bearer ${token}`);
  }

  // 4. Perform Fetch
  try {
    const response = await fetch(url.toString(), {
      method,
      headers: requestHeaders,
      body: body ? JSON.stringify(body) : undefined,
      signal,
    });

    const data = await response.json().catch(() => null);

    // 5. Handle Global Status Codes
    if (!response.ok) {
      if (response.status === 401) {
        // Handle Logout
        console.warn("Session expired. Redirecting...");
      }
      throw new ApiError(
        response.status,
        data?.message || response.statusText,
        data,
      );
    }

    return data as T;
  } catch (error) {
    if (error instanceof ApiError) throw error;
    if (error instanceof Error && error.name === "AbortError") throw error;

    // Fallback for network errors
    throw new ApiError(0, "Network failure or unexpected error", error);
  }
}

/**
 * Convenience Methods
 */
export const api = {
  get: <T>(url: string, params?: ApiRequestOptions["params"]) =>
    apiRequest<T>(url, { method: "GET", params }),

  post: <T>(url: string, body: any) =>
    apiRequest<T>(url, { method: "POST", body }),

  put: <T>(url: string, body: any) =>
    apiRequest<T>(url, { method: "PUT", body }),

  patch: <T>(url: string, body: any) =>
    apiRequest<T>(url, { method: "PATCH", body }),

  delete: <T>(url: string) => apiRequest<T>(url, { method: "DELETE" }),
};
