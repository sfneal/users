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
- cut 'plan_management_buckets' attribute from filables.
