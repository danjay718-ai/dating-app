# Architectural Decision Document

## Project

Kindred is a Laravel dating-style proof of concept. The goal is to show clean Laravel structure, practical database design, Eloquent relationships, basic validation, and a usable interface while staying within the requested test scope.

This project intentionally avoids production-level complexity. The implementation focuses on the requested features first:

- User registration and login
- Basic user profile with name, age, bio, gender, looking-for preference, and location
- Browse/discover profiles returned from the database
- Messaging/conversations between users
- Migrations and Eloquent relationships
- Basic validation and a clean usable interface
- Docker Compose setup for local testing

## Technical Stack

- Laravel 13
- Laravel Breeze-style authentication flow
- Blade server-rendered views
- Tailwind CSS and Vite for styling and assets
- Alpine.js for small interactions
- MySQL for Docker-based local development
- SQLite-compatible tests for fast local verification
- Plain Docker Compose, not Laravel Sail

## Scope Decision

The project follows the requested proof-of-concept scope instead of trying to become a full dating product. Several parts of the UI were improved to make the reviewer experience cleaner, but the backend remains intentionally small and readable.

This keeps the work aligned with the test expectations: code quality, structure, relationships, validation, and a working end-to-end flow matter more than building advanced matching, realtime infrastructure, notifications, subscriptions, or media upload pipelines.

## Main Application Flow

Users can:

- Register and log in
- Create and update their profile
- Browse compatible profiles from the database
- Start or open a conversation
- Send and view messages without a full page reload

## Database Design

### users

Stores authentication data.

Key fields:

- id
- name
- email
- password
- timestamps

### profiles

Stores dating profile information separately from authentication data.

Key fields:

- id
- user_id
- age
- bio
- gender
- looking_for_gender
- location
- timestamps

Decision: profile information is separated from `users` so authentication stays clean and profile-specific fields can grow independently later.

### conversations

Stores conversation containers.

Key fields:

- id
- timestamps

Decision: the conversation itself does not store `user_one_id` and `user_two_id`. Participants are stored in a separate table so the relationship stays normalized and flexible.

### conversation_participants

Stores users that belong to a conversation.

Key fields:

- id
- conversation_id
- user_id
- timestamps

Constraint:

- unique `conversation_id` and `user_id`

Decision: the current product uses one-to-one conversations, but this table avoids hardcoding that limitation directly into the conversation record.

### messages

Stores messages inside conversations.

Key fields:

- id
- conversation_id
- sender_id
- body
- read_at
- timestamps

Decision: messages belong to conversations and track the sender. This keeps the message history independent from the participants list.

## Eloquent Relationships

The core relationships are:

- `User` has one `Profile`
- `User` belongs to many `Conversation` records through `conversation_participants`
- `User` has many `Message` records as sender
- `Profile` belongs to `User`
- `Conversation` belongs to many `User` records through `conversation_participants`
- `Conversation` has many `Message` records
- `ConversationParticipant` belongs to `Conversation`
- `ConversationParticipant` belongs to `User`
- `Message` belongs to `Conversation`
- `Message` belongs to `User` as sender

## Backend Structure

The backend uses normal Laravel layers:

- Controllers for HTTP request and response handling
- Form requests for validation
- Actions for focused business operations
- Eloquent models for relationships and persistence
- Blade views for the proof-of-concept interface

The goal is not to create unnecessary abstraction. The goal is to avoid putting all behavior directly inside controllers once the behavior starts becoming reusable or multi-step.

## Actions Instead Of Large Services

This project uses action classes for focused operations such as starting conversations and sending messages.

Actions were chosen instead of broad service classes because the behavior is small and task-oriented. A service class can become a generic container for unrelated methods, especially in a proof of concept. Actions keep each operation explicit, easy to test, and easy to locate.

This is cleaner than placing everything in the controller because controllers should mainly coordinate the request lifecycle:

- receive the request
- authorize the user
- call the focused application logic
- return a response

Keeping conversation and message creation logic in actions makes the controller smaller and keeps business rules reusable if the project later adds API routes, notifications, realtime broadcasting, or background jobs.

## Form Requests And Validation

Form requests were added for profile and message input. Validation is intentionally practical and light because the project is a proof of concept.

Examples of current validation choices:

- Name is required where profile ownership/profile updates need it
- Age must be numeric and within a reasonable range
- Bio is optional with a maximum length
- Gender and looking-for fields are limited to supported values
- Location is optional with a maximum length
- Message body is required and length-limited

This is enough to demonstrate Laravel validation structure and protect the core flows without spending time on production-only concerns such as moderation, identity checks, image review, spam controls, rate limiting rules, or advanced matching validation.

## Authorization Decision

The app includes authorization checks for the important user boundaries:

- A user can only edit their own profile
- A user cannot start a conversation with themselves
- A user can only view conversations where they are a participant
- A user can only send messages to conversations where they are a participant

This is handled through Laravel authorization patterns and controller-level checks where appropriate. That keeps the proof of concept understandable while still protecting the core data boundaries.

## Frontend And UX Decision

The UI was improved beyond plain HTML to make the test easier to review and use. The pages include a modern landing page, authentication screens, discover cards, app sidebar, and a messages workspace.

The frontend remains Blade-based rather than a SPA. This is intentional because a SPA would add extra architecture and build complexity that was not required. Blade is enough for the requested proof of concept and keeps the Laravel backend visible.

The browse/discover page only displays profiles returned from the database. Placeholder or future-only fields are avoided in the core profile cards unless they are clearly noted as future work.

## Messaging Behavior

Messages can be sent without a full page reload by using a lightweight asynchronous request from the Blade page. This improves usability while avoiding a full realtime stack.

Laravel Reverb was not implemented in this proof of concept. Reverb would be the stronger production-style approach for realtime messaging because it can broadcast new messages immediately to conversation participants. It was left out because it requires extra infrastructure, event broadcasting setup, frontend subscription logic, and more test surface than the assignment asks for.

For this test, lightweight async sending is a better fit: it demonstrates the messaging flow, keeps the app usable, and avoids over-engineering.

## Docker Decision

The project uses plain Docker Compose instead of Laravel Sail because the additional instruction asked for Docker itself. The Docker setup includes:

- PHP-FPM application container
- Nginx web server container
- MySQL database container
- Node container for frontend asset commands

This gives reviewers a repeatable local environment without requiring them to install PHP, Composer, Node, or MySQL directly on their machine.

## Deferred Production Concerns

The following were intentionally not implemented because they are outside the proof-of-concept scope:

- Laravel Reverb for realtime messaging
- Redis for cache, queues, and broadcasting
- Queue jobs for notifications, email, message delivery events, or media processing
- Image upload and moderation
- Advanced matching algorithms
- Profile verification
- Online presence tracking
- Typing indicators and read receipts
- Search indexing
- API token/mobile app support
- Admin moderation tools
- Rate limiting beyond Laravel defaults
- Production observability and alerting

Redis would be a good production addition for cache, sessions, queues, and broadcasting coordination. Jobs would also be useful once the app sends emails, push notifications, moderation tasks, or expensive matching calculations. They were skipped here because adding workers, queue monitoring, retry behavior, and failure handling would expand the project beyond the requested test.

## Future Improvements

If the project continued beyond the proof of concept, the most useful next steps would be:

- Add Laravel Reverb for realtime incoming messages
- Add Redis-backed cache, queues, and possibly sessions
- Add queued notifications for new messages and matches
- Add profile photos with validation and storage
- Add online/offline presence
- Add better matching rules based on distance, hobbies, and activity
- Add message read receipts and typing indicators
- Add profile view and like tracking from real events
- Add policy classes where authorization rules grow
- Add broader feature and browser tests
- Add production Docker hardening and deployment configuration

These are intentionally framed as future work. The current implementation prioritizes completing the assignment requirements cleanly instead of over-engineering the proof of concept.

## AI Assistance Note

This project used AI assistance:

- Claude chat was used for planning and architecture decisions.
- Codex CLI was used for UI design support, implementation assistance, and code iteration.

The final structure, scope, and implementation decisions were reviewed manually.
