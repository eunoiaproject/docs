# Contributing to Eunoiaverse Platform

First on, thank you for considering contributing to Eunoiaverse! It's people like you that make this project great. Your contributions are valuable and help us improve.

This document provides guidelines for contributing to the project. Please feel free to propose changes to this document in a pull request.

## Code of Conduct

This project and everyone participating in it is governed by the Eunoiaverse Code of Conduct. By participating, you are expected to uphold this code. Please report unacceptable behavior to team@eunoiaverse.local.

## How Can I Contribute?

### Reporting Bugs
- Use the GitHub issue tracker to report bugs.
- Ensure the bug was not already reported by searching on GitHub under **Issues**.
- If you're unable to find an open issue addressing the problem, open a new one. Be sure to include a **title and clear description**, as much relevant information as possible, and a **code sample or an executable test case** demonstrating the expected behavior that is not occurring.

### Suggesting Enhancements
- Open a new issue to discuss your proposed enhancement. This allows us to coordinate efforts and prevent duplication of work.
- Clearly describe the proposed enhancement and its benefits.

### Pull Requests
- We welcome pull requests for bug fixes, new features, and documentation improvements.
- Please follow the workflow described below.

## Development Setup

Before you can contribute, you need to set up your local development environment.

1.  **Fork** the repository on GitHub.
2.  **Clone** your fork locally:
    ```bash
    git clone https://github.com/eunoiaproject/eunoiaverse.git
    cd eunoiaverse
    ```
3.  **Install dependencies**:
    ```bash
    composer install
    ```
4.  **Set up the database** and configure your connection as described in `QUICK_REFERENCE.md` and `INSTALLATION.md`.
5.  **Run the development server**:
    ```bash
    php -S localhost:8080
    ```

For more detailed setup instructions, please refer to the `DEVELOPMENT.md` file.

## Contribution Workflow

### 1. Create a Branch
All development happens on the `develop` branch. Pull requests should be made from a feature branch into `develop`.

```bash
# Switch to the develop branch
git checkout develop

# Create a new branch for your feature or bugfix
git checkout -b feature/your-feature-name
# or
git checkout -b bugfix/issue-description
```

### 2. Make Changes
- Write clean, readable code that follows our code standards.
- Ensure your changes are well-tested.

### 3. Run Tests
Before committing, run the full test suite to ensure everything is working correctly.

```bash
composer test
```

### 4. Commit Your Changes
Follow our commit message convention. This helps us generate release notes and understand the history of the project.

**Commit Message Format:**
```
type: Short description of changes
```
**Types:** `feat`, `fix`, `docs`, `style`, `refactor`, `test`.

**Example:**
```
feat: Add product search functionality
```

### 5. Submit a Pull Request
1.  Push your branch to your fork on GitHub.
2.  Open a pull request from your feature branch to the `eunoiaproject/eunoiaverse` `develop` branch.
3.  Provide a clear description of the changes in your pull request and link to any relevant issues.
4.  Wait for a code review. We will review your PR as soon as possible.

## Coding Standards

### PHP
- Follow the **PSR-12** coding standard.
- Use type hints for function arguments and return values.
- Write comprehensive docblocks for all classes and methods.

### JavaScript
- Use modern **ES6+** syntax.
- Use `const` and `let` instead of `var`.

### Security
- **Prevent SQL Injection**: Always use **prepared statements** for database queries.
- **Prevent XSS**: Sanitize all user-provided output using `htmlspecialchars()`.

## Our Technology Stack

Our core stack includes:

-   **Backend**: PHP
-   **Frontend**: HTML, CSS (with Tailwind CSS), and Vanilla JavaScript (ES6+)
-   **Database**: MySQL
-   **Infrastructure**: We use services like AWS S3.
-   **Tooling**: Node.js is used for frontend development and tooling (e.g., `http-server`).

## Proposing Enhancements and New Technologies

We are always open to new ideas! If you'd like to propose incorporating new technologies (e.g., Python, Go, or mobile frameworks like Flutter/Dart for Android/iOS), please open an issue first to discuss the idea with the maintainers.

1.  **Open an Issue**: Create a new issue on GitHub with the `[Enhancement]` or `[Proposal]` tag.
2.  **Describe the Idea**: Clearly explain the technology you are proposing and the problem it solves or the value it adds to the Eunoiaverse platform.
3.  **Discuss**: Be prepared to discuss the pros and cons with the project maintainers. We want to ensure any new addition aligns with the project's long-term goals and architecture.

Thank you for your contribution!