# Changelog

All notable changes to `users` will be documented in this file

## 0.1.0 - 2020-11-09
- initial release


## 0.1.1 - 2020-11-19
- fix composer requirements


## 0.1.2 - 2020-11-19
- fix User model trait use


## 0.1.3 - 2020-11-19
- (trigger Travis CI build after api being unresponsive earlier)
- fix User model trait use


## 0.1.4 - 2020-11-19
- fix min phpunit package version in order to pass Travis CI tests


## 0.2.0 - 2020-11-30
- fix sfneal/casts min version requirement to allow support for php8


## 0.2.1 - 2020-11-30
- fix min sfneal/casts version


## 0.2.2 - 2020-12-09
- cut isBucketPermitted & validatePlanReviewRequest methods
- add support for php8


## 0.2.3 - 2020-12-09
- cut getImageAttribute() method from User model


## 0.3.0 - 2020-12-22
- add 'textarea' attribute accessor to User model for editing a User's model


## 0.3.1 - 2020-12-23
- cut unused methods from User model


## 0.4.0 - 2021-02-01
- bump min casts, scopes, address, caching, currency & models package versions to 1.0


## 0.4.1 - 2021-02-01
- cut support for php7.2


## 0.5.0 - 2021-02-03
- add sfneal/datum (merged filters & queries) composer requirement
- cut composer requiring of abandoned sfneal/filters & sfneal/queries packages


## 0.6.0 - 2021-02-05
- cut composer requiring of abandoned sfneal/laravel-custom-casts & replaced with vkovic/laravel-custom-casts


## 0.6.1 - 2021-02-11
- bump sfneal/datum package min version to 0.8
- extensions of AbstractQuery to implementations of Query interface.


## 0.7.0 - 2021-02-15
- bump sfneal/datum package min version to 0.11
- refactor implementations of Query interface to extensions of abstract Query class
- add implementations of protected builder() method in Query extensions


## 0.8.0 - 2021-02-18
- bump sfneal/datum package min version to 1.0 (initial production release)
- make ServiceProvider that publishes a config file with organization constants
- make OrganizationService for accessing org constants (name, address, phone, etc)
- add config tests to the test suite
- cut autoloading of auth.php helper functions


## 0.8.1 - 2021-02-18
- add 'email_footer' attribute accessor to User model for retrieving a custom email footer for any User
- cut 'plan_management_buckets' attribute from fillables.


## 0.8.2 - 2021-03-01
- add `isWebDeveloper()` method to User model for checking User roles
- fix `isAdmin()` method to return true if the user has a 'web developer' role


## 0.8.3 - 2021-03-17
- add `whereNotRole()`, `whereRoleIn()`, `whereRoleNotIn()`, `whereRole()` & `orWhereRole()` methods to UserBuilder
- add`whereName()` method to RoleBuilder


## 0.8.4 - 2021-03-17
- add new methods to `UserBuilder` & `RoleBuilder` for scoping query results with 'role' clauses


## 0.8.5 - 2021-03-17
- refactor `whereNotUser()` method to `whereUserNot()`
- add `whereUserNotIn()` method to UserBuilder


## 0.8.6 - 2021-03-31
- cut use of `AbstractService` extensions


## 0.9.0 - 2021-04-01
- bump sfneal/currency dependency to 2.0


## 0.9.1 - 2021-04-06
- fix sfneal/models version constraint (^1.0)
- fix sfneal/address version constraint (^1.1.0)


## 0.10.0 - 2021-04-07
- bump sfneal/models min version to v2.0
- bump sfneal/caching to latest the version to avoid dependency conflicts


## 0.10.1 - 2021-04-07
- bump sfneal/models min version to v2.1
- refactor use of `Authenticatable` to `AuthModel`


## 0.11.0 - 2021-04-29
- add test suite for testing builders, factories, queries, config, migrations, helper functions, etc
- bump sfneal/datum min version to v1.4.1
- bump sfneal/mock-models min version to v0.5


## 0.11.1 - 2021-04-29
- fix issue with `UserBuilder::allWithInactive()` methods return type hinting
- add`allWithInactive()` test method to `UserBuilderTest`


## 0.11.2 - 2021-04-29
- fix 'user' table migration 'bio' column definition to use `mediumText()` instead of `text()`
- add phpunit min version


## 0.11.3 - 2021-05-03
- fix user migration's 'role_id' column to be nullable to allow use of `UserFactory` with creating a 'role' relationship


## 0.11.4 - 2021-05-04
- bump sfneal/laravel-helpers min version to v2.0 to enable use of `AppInfo` when installing using '--prefer-lowest' flag
- bump sfneal/post-office min version to v0.8
- refactor import of Sfneal\PostOffice\Notifications `AbstractNotification` to `Notification`


## 1.0.0 - 2021-05-05
- initial production release
- bump sfneal/post-office min version to v1.0
- fix issues with `HelpersTest::isAdminOrActiveUser()` test method


## 1.0.1 - 2021-05-18
- fix issue with `DatabaseSeeder` causing ambiguous class resolutions
- refactor all the seeders to tests namespace except `RoleSeeder` which can be used in production


## 1.0.2 - 2021-06-29
- fix issue with `User` & `Role` models declarations of static `boot()` methods


## 1.1.0 - 2021-07-19
- cut `User` model's 'password' attribute mutator that was causing already hashed passwords to be hashed again


## 1.1.1 - 2021-07-28
- optimize database factory & seeder autoloading 
- optimize testing seeders to be autoloaded to `Database\Seeders` namespace


## 1.1.2 - 2021-08-03
- fix min sfneal/address version to v1.2.2 to fix issues with previously fixed `AddressFactory` issue


## 1.1.3 - 2021-08-04
- bump sfneal/mock-models min dev requirements to v0.9
- refactor import of `ModelAttributeAssertions` to `AssertModelAttributes`


# 1.1.4 - 2021-08-18
- fix sfneal/address min version to v1.2 since broken v1.2.0 & v1.2.1 versions have been removed 


# 1.1.5 - 2021-08-31
- add support for sfneal/caching v2.0
- fix use of '#' cache key id suffix delimiter with ':'


# 1.2.0 - 2021-09-02
- bump sfneal/address & sfneal/models to latest versions to support use of `Address` accessor traits
- add use of `AddressAccessors` trait in `User` model for providing access to related `Address` model attributes
- add `accessors_are_accessible()` test method to `UserTest` for testing attribute accessors
- fix composer package constraints to be more explicit


# 1.3.0 - 2021-09-03
- fix issues with use of `invalidateCache()` methods not properly clearing cache
- add assertions methods `UserRolesQueryTest` to confirm cache was properly cleared
- bump sfneal/caching min version to v2.1.2 to support latest implementations of cache invalidation


# 1.3.1 - 2021-09-07
- bump min sfneal/models packages version to v2.8.1
- add assertions to `UserListQueryTest` now that issues with Sqlite concat & if statements has been resolved


# 1.4.0 - 2021-09-07
- refactor `UserListQuery` to accept a name query string as a parameter instead of a Request #43

 
# 1.4.1 - 2021-09-08
- fix issue with `UserBuilder::whereNameLikeRaw()` method causing errors when wrapping names with apostrophes (like "O'hare") #56
- add use of `runTestFiveTimesProvider()` data provider for forcing test methods that use random attributes to run multiple times #48


# 1.4.2 - 2022-03-04
- add support for sfneal/caching v3.0
- add use of GitHub actions/workflows


# 2.0.0 - 2024-04-15
- add support for PHP 8.2
- add new GH actions
