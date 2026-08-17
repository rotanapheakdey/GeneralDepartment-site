---
name: e2e-verifier
description: Uses the built-in Chrome browser subagent to test authentication, user flows, and responsive UI layouts for Inertia/Vue and Filament.
---

# E2E Browser Testing Recipe (Vue/Inertia & Filament)

## Execution Steps

1. Verify the dev server is active. Ensure `npm run dev` or `npm run build` has been executed if frontend assets were modified.
2. Open the browser subagent and navigate to the target route.
3. Perform standard interaction runs:
    - **Frontend (Vue/Inertia):** Click `<Link>` components and verify that SPA hydration occurs without a full page reload. Submit forms using Inertia `useForm` and ensure loading indicators and error messages appear without page refresh.
    - **Admin Panel (Filament):** Interact with Livewire components and ensure background requests succeed without breaking the DOM.
    - Submit valid data -> assert success redirect or state change.
    - Submit invalid/empty data -> assert UI validation messages appear natively or via Inertia errors.
4. Take a snapshot of the final DOM and review console logs for uncaught Vue/Inertia exceptions.
