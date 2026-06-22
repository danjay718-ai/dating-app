## **Architectural Decision Document** 

## **Project** 

Laravel Dating-Style Proof of Concept 

## **Purpose** 

This project is a small proof of concept for a simple dating-style web application. The main goal is to demonstrate clean Laravel backend structure, sensible database design, Eloquent relationships, and a usable interface. 

The application is intentionally not production-ready or feature-heavy. The focus is on maintainability, clarity, and showing that the foundation can be extended if needed. 

## **Technical Stack** 

- Laravel 

- Laravel Breeze for authentication 

- Blade for server-rendered views 

- Tailwind CSS for simple UI styling 

- Alpine.js for small frontend interactions 

- MySQL as the database 

- Docker / Laravel Sail for local development 

## **Architecture Decision** 

The application will use a Blade-based frontend while keeping the backend structured in an API-ready way. 

The project will not be built as a full SPA. Instead, Blade will be used for the proof of concept interface, while backend logic will be separated cleanly through controllers, form requests, actions, models, and API resources where appropriate. 

This approach keeps the project realistic for a proof of concept while still showing scalable backend structure. 

## **Main Application Flow** 

Users can: 

- Register and log in 

- Create or update their basic profile 

- Browse other user profiles 

1 

- Start a conversation with another user • Send and view messages inside conversations 

## **Core Entities** 

The main entities are: 

- User • Profile 

- Conversation 

- Conversation Participant 

- Message 

## **Database Design** 

## **users** 

Stores authentication-related user data. 

Main fields: 

- id 

- name 

- email • password • timestamps 

## **profiles** 

Stores dating profile information separate from authentication data. 

Main fields: 

- id • user_id • age • bio • gender • looking_for_gender • location • timestamps 

Decision: 

Profile data is separated from the users table to keep authentication data clean and to allow profile-specific fields to grow independently. 

2 

## **conversations** 

Stores conversation containers. 

Main fields: 

• id • timestamps 

Decision: 

The conversations table does not directly store `user_one_id` and `user_two_id` . Participants are stored separately in a pivot-style table to keep the structure more flexible and normalized. 

## **conversation_participants** 

Stores users who belong to a conversation. 

Main fields: 

- id • conversation_id • user_id • timestamps 

Constraints: 

- unique conversation_id and user_id combination 

Decision: 

This structure supports cleaner relationships and avoids hardcoding the conversation to only two users at the database level, even though the proof of concept will only use one-to-one conversations. 

## **messages** 

Stores messages sent inside conversations. 

Main fields: 

- id • conversation_id • sender_id • body • read_at • timestamps 

Decision: 

3 

Messages belong to a conversation and have a sender. This keeps message history separate from participants and allows conversations to scale cleanly. 

## **Eloquent Relationships** 

## **User** 

- hasOne Profile 

- belongsToMany Conversation through conversation_participants 

- hasMany Message as sender 

## **Profile** 

- belongsTo User 

## **Conversation** 

• belongsToMany User through conversation_participants • hasMany Message 

## **ConversationParticipant** 

• belongsTo Conversation • belongsTo User 

## **Message** 

• belongsTo Conversation • belongsTo User as sender 

## **Backend Structure** 

The backend will be organized using: 

- Controllers for request handling 

- Form Requests for validation 

- Actions for business logic 

- Eloquent models for relationships 

- API Resources for API-ready response formatting where useful 

Suggested structure: 

```
app/
  Actions/
    Conversations/
      StartConversationAction.php
      SendMessageAction.php
```

4 

```
  Http/
    Controllers/
      Web/
        ProfileController.php
        BrowseProfileController.php
        ConversationController.php
        MessageController.php
      Api/
        ProfileController.php
        ConversationController.php
        MessageController.php
    Requests/
      Profile/
        UpdateProfileRequest.php
      Message/
        StoreMessageRequest.php
    Resources/
      ProfileResource.php
      ConversationResource.php
      MessageResource.php
```

```
  Models/
    User.php
    Profile.php
    Conversation.php
    ConversationParticipant.php
    Message.php
```

## **Validation Decision** 

Form validation will be kept practical and minimal because this is a proof of concept. 

The goal is not to cover every possible production validation rule. Instead, the project will validate the most important inputs needed to keep the application functional and safe enough for review. 

Example validation rules: 

## **Profile** 

- name is required 

- age is required, numeric, and within a reasonable range 

5 

- bio is optional but has a maximum length • gender is optional or limited to predefined values 

- location is optional with a maximum length 

## **Message** 

- message body is required • message body has a maximum length 

Decision: 

The project will avoid complex validation such as content moderation, profile verification, image validation, matching rules, and advanced filtering because these are outside the proof of concept scope. 

## **Authorization Decision** 

Users should only access data they are allowed to see. 

Rules: 

- A user can only edit their own profile 

- A user cannot start a conversation with themselves 

- A user can only view conversations where they are a participant 

- A user can only send messages to conversations where they are a participant 

Authorization may be handled through controller checks, policies, or action-level guards depending on what keeps the implementation clean and readable. 

## **UI Decision** 

The UI will use Blade, Tailwind CSS, and small Alpine.js interactions. 

The frontend will be clean but intentionally simple. 

The goal is usability, not visual complexity. 

Pages: 

- Dashboard 

- Edit profile 

- Browse profiles 

- View profile 

- Conversation list 

- Conversation detail 

- Send message form 

6 

Alpine.js will only be used for small interface interactions such as dropdowns, simple toggles, or confirmation states. 

## **API-Ready Decision** 

Although the proof of concept will primarily use Blade views, the backend will be structured in a way that can support an API later. 

This means: 

- Business logic will not be placed directly inside Blade files • Controllers will stay thin 

- Reusable logic will be placed in Actions • API Resources may be added for structured JSON responses • Database relationships will be normalized and scalable 

Decision: 

The project will be API-ready by design, but it will not overbuild a complete API unless needed for the proof of concept. 

## **Scope Boundaries** 

Included: 

- Authentication • Basic profiles • Browse profiles 

- Conversations • Messaging • Clean migrations and relationships • Docker setup • Basic validation 

- Basic Blade UI 

Not included: 

- Real-time messaging • Profile photos • Matching algorithm • Likes/swipes • Notifications • Email verification customization 

- Admin panel 

- Payment features 

- Advanced search 

- Content moderation 

7 

- Production-grade security hardening 

## **Reasoning** 

The client requested a proof of concept that focuses on backend quality, clean structure, and sensible implementation choices. 

This architecture keeps the application small enough to finish within the requested timeframe while still showing professional Laravel practices. 

The main goal is to deliver a working, understandable, and extendable Laravel application instead of a feature-heavy prototype that is harder to review. 

## **AI Usage Disclosure** 

AI may be used as a planning and review assistant for architecture, code organization, and documentation. 

All implementation decisions and final code will be reviewed manually before submission. 

8 

