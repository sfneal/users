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
