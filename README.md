# modular-architecture
Test app to prove some ideas for modular monolith

## Conception
The app contains from some basic components. E.g. User, News, Fields and so on. And each this component has it's own structure (in terms of DB/ORM), 
own logic and usecases. And this information must not be shared with other components (modules).

This is kind of combination above 
- [Clean Architecture](https://blog.cleancoder.com/uncle-bob/2012/08/13/the-clean-architecture.html) suggested by Robert Martin
- Modular architecture principe
- [Porto pattern](https://github.com/Mahmoudz/Porto)

There are few rules that app must follow:
1. Communication between modules must be restricted and strictly managed - to avoid having any coupling and to prevent having the app as a "big ball of mud"
2. Relatios between modules must be under strict control. Relations must be acyclomatic (have no loops)
3. Interactions and communication inside the module should be under the strict control, and it must have strict direction

## Module structure
1. Each feature represented as a standalone folder inside the `app` folder. (see `News` and `User` as an example)
2. Each module/feature has following structure:
  - `Entrypoint`          - The only place which module can be reached by. Even by other modules(?). Normally there should be stored controllers and commands
  - `Application`         - The layer with application logic, responsible for all the things normal app may need: validation, request/respons transformation and so on
  - `Domain`              - The business logic layer. All the business rules must be here. Should use Rich Models (Models that encapsulate the whole logic and transitions). 
                            Probably may have additional Models/Services to split the Root model into parts. Normaly there should be only one Model as a Root (Aggregate), 
                            and all other Models should be part of it. This layer clean and do not care about world outside it (DB, ORM, Conroller, Framework, etc - out of it).
                            It defines interfaces to perform different operations with outer world
  - `Infrastructure`      - The "dirty" layer. It has implementation for all interfaces defined on Domain leayer, know how to retrieve and store Model, 
                            which table(s) it need to be stored and so on. May have dependencies on ORM/Framework
  - `Config`              - Configuration files that current module need (routing for example)
  - `PackageProvider.php` - class that inherits ServiceProvider from Laravel and used to integrate module into the ecosystem
  
  ## Communication between layers (inside the module)
  The only possible flow (direction) is:
  `Entrypoint` -> `Application` -> `Domain` <- `Infrastructure`

  **Example:**
  
  Request: Controller -> (map request into dto) -> Application -> Domain
  Response: Domain -> Application -> (map response into dto) -> Controller -> Normalize/Serialize


  It means that:
  - `Entrypoint` knows how to process the task with help of `Application`, but has no info about other layers.
  - `Application` Knows how to perform the task through the `Domain`, but has no info about other layers.
  - `Domain`, has no info about other layers (it interacts with outer world through the interfaces).
  - `Infrastructure` knows how to implement `Domain` needs, but has no info about other layers.

## Boundaries
Between layers there are boundaries. It need to encapsulate and filter information that transfered from one layer to another. 
And to avoid adding any coupling between levels

- Do we always need to create new DTO when data crosses the border?
- May be it is reasonable for Entrypoint/Application layers only?

## Control and monitoring
We cannot trust developers - anyone can do a mistake or to be lazzy.. 
So we need to control dependency graph and rise errors when any rule mentioned above is broken

Useful tools:
- [deptrac](https://qossmic.github.io/deptrac/) static code analysis tool for PHP to visualize and enforce architectural decisions
- [PHPArch?](https://github.com/j6s/phparch) architectural testing library for PHP projects
- [PHP Architecture Tester?](https://github.com/carlosas/phpat) a static analysis tool to verify architectural requirements
- [PHPUnit Application Architecture Test?](https://github.com/ta-tikoma/phpunit-architecture-test) The extension for PHPUnit to write architectural tests


## Run this example
 - `docker-compose up -d`
 - `curl "http://localhost:8000/users?first_name=foo&last_name=bar"` To create user
 - `curl "http://localhost:8000/news"` To get news list
