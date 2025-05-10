# PHP Backend Framework From Scratch
This is a pet project of mine, to build a lightweight Laravel/MVC‑style framework with nothing more than PHP’s standard library. Every component—from autoloading to the service container—has been implemented manually as an exercise in building the mechanics normally provided out-of-the-box by frameworks and libraries.

## Current features 

| Area | What’s implemented |
|------|-------------------|
| **Autoloading** | Custom PSR‑4‑style loader wired with `spl_autoload_register`; no Composer needed. |
| **Router** | Fluent router supporting `GET`, `POST`, `PUT`, `PATCH`, `DELETE`, route parameters, and named controller actions (`[Controller::class, 'method']`). |
| **Middleware** | Global, group, and route‑level middleware chains. |
| **Pipeline** | Lightweight functional pipeline that composes middleware (or any “pipes”) into one callable stack (`Pipeline::run()->through()->send()->then()`). |
| **Service Container** | Dependency‑injection container with `singleton`, `bind`, and auto‑resolution helpers. |
| **Service Providers** | Modular bootstrapping: each provider puts bindings in `register()` and kickoff logic in `boot()`. |
| **Sessions** | Custom `DatabaseSessionHandler` implementing `SessionHandlerInterface`; sessions live in MySQL for horizontal scaling. |
| **Database** | Thin PDO wrapper for DSN building, prepared statements, and config aggregation. |
| **Kernel** | Central entrypoint that resolves the request, runs the pipeline/middleware stack, and returns a response. |


## Todo
- handle auth
- set up tests -- should be able to install a testing library but that would likely involve using Composer's autoloading
- request validator class
- implement rate limiting
- handle migrations
- I'm not sure that I ever want to go through the process of creating an ORM, but I should make it easy to install and use one
- turn this into a library so that it is easy to use in projects 
