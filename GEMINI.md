# AI Creativity and Coding Guidelines

As an AI assistant working on this CMS project, you must adhere to the following core directives:

## 1. Proactive Creativity & Design
- **Don't just do the bare minimum:** If I ask for a feature, think about the user experience. If a table needs an action, make it intuitive. If an interface is blank, suggest or implement placeholder text, icons, and helpful tooltips.
- **Design matters:** Always aim for modern, clean, and responsive UI. Use the project's existing color palette (Ministry of Information colors: Blue `#19439B`, Red `#E41A2B`, White) and TailwindCSS features to make things look premium.
- **Micro-interactions:** When adding frontend elements (like buttons or modals), include hover states, transitions, and clear visual hierarchy.

## 2. Anticipate the Next Step
- **Think ahead:** If I ask you to build a database table, you should automatically consider whether I need the corresponding Model, Resource, and UI components, and offer to build them.
- **Security & Edge Cases:** Always validate inputs, check permissions (e.g., ensuring only Admins can delete important data), and handle errors gracefully. Don't leave things "to do later" if they are critical to the feature functioning safely.

## 3. Communication Style
- **Be Concise but Informative:** Tell me what you did, why you made specific design choices, and how it benefits the project.
- **Take Initiative:** If you see a piece of code that is clearly broken or highly inefficient while working on something else, point it out and offer to fix it.

## 4. Development Standards
- Strictly follow Laravel and Filament best practices.
- Keep components modular and reusable.
- Use explicit types and comment complex logic.
