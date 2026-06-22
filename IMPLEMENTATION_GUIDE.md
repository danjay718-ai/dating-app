# Implementation Checklist: Laravel Dating PoC

This document serves as a step-by-step guide for implementing the Laravel Dating-Style Proof of Concept based on the Architectural Decision Document.

## Phase 1: Environment & Authentication Setup
- [x] **Scaffold Laravel Project:** (Completed!)
- [ ] **Setup Laravel Sail (Docker) [Optional but recommended]:**
  - Run `php artisan install:api` (if you want an API) or simply `php artisan sail:install` to set up Docker containers for MySQL/Redis.
- [ ] **Install Laravel Breeze:**
  - Run `composer require laravel/breeze --dev`
  - Run `php artisan breeze:install blade` (Select Blade when prompted, and Alpine/Tailwind will be configured automatically).
  - Run `npm install && npm run build`
  - Run `php artisan migrate`

## Phase 2: Database & Models
- [ ] **Generate Models & Migrations:**
  - `php artisan make:model Profile -m`
  - `php artisan make:model Conversation -m`
  - `php artisan make:model ConversationParticipant -m`
  - `php artisan make:model Message -m`
- [ ] **Write Migrations:** Update the generated migration files with the fields specified in the ADD (e.g., age, bio, gender for profiles; sender_id, body for messages).
- [ ] **Define Eloquent Relationships:**
  - Update `User.php` (`hasOne Profile`, `hasMany Message`, `belongsToMany Conversation`).
  - Update `Profile.php` (`belongsTo User`).
  - Update `Conversation.php` (`hasMany Message`, `belongsToMany User`).
  - Update `Message.php` (`belongsTo Conversation`, `belongsTo User`).
- [ ] **Database Seeder & Factories:**
  - Create factories: `php artisan make:factory ProfileFactory` (and others).
  - Update `DatabaseSeeder.php` to generate 10-20 fake users and profiles so you have data to test with.

## Phase 3: Business Logic (Actions)
- [ ] Create a new directory: `app/Actions`
- [ ] **Profile Actions:**
  - Create `app/Actions/UpdateProfileAction.php` (handles saving bio, location, etc.).
- [ ] **Conversation Actions:**
  - Create `app/Actions/StartConversationAction.php` (checks if a chat exists between two users; if not, creates one and attaches participants).
  - Create `app/Actions/SendMessageAction.php` (creates a message inside a conversation).

## Phase 4: Controllers & Validation
- [ ] **Create Form Requests for Validation:**
  - `php artisan make:request UpdateProfileRequest`
  - `php artisan make:request StoreMessageRequest`
- [ ] **Create Controllers:**
  - `php artisan make:controller ProfileController`
  - `php artisan make:controller BrowseProfileController`
  - `php artisan make:controller ConversationController`
  - `php artisan make:controller MessageController`
- [ ] **Wire up Routes:** Update `routes/web.php` and wrap them in the `auth` middleware so only logged-in users can access them.

## Phase 5: The UI (Blade + Tailwind)
- [ ] **Extend Breeze Layout:** Use the existing `layouts.app` component from Breeze as the shell for your pages.
- [ ] **Profile Views:**
  - Build `resources/views/profile/edit.blade.php` (Form to update age, bio, etc.).
  - Build `resources/views/browse/index.blade.php` (A grid layout displaying user profiles).
- [ ] **Messaging Views:**
  - Build `resources/views/conversations/index.blade.php` (List of active chats).
  - Build `resources/views/conversations/show.blade.php` (The actual chat UI showing messages and a form to send a new one).

## Phase 6: Authorization & Polish
- [ ] **Create Policies:**
  - `php artisan make:policy ProfilePolicy` (Users can only edit their own profile).
  - `php artisan make:policy ConversationPolicy` (Users can only view/message in their own conversations).
- [ ] **Final Polish:** Ensure Tailwind styling is clean and test the core loop (Login -> Browse -> Start Chat -> Send Message).

***

**Tip:** I highly recommend using the split terminal to run `npm run dev` in the background so your Tailwind classes compile automatically as you build out the Blade views.
