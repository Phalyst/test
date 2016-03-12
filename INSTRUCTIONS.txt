The company service class manages companies and their users. Each user has a type
that states if they are a user of high worth or low worth. Each user also belongs to a company.

The challenge is to refactor and abstract the code to get rid of duplication and potential
pitfalls in future maintenance. You can change anything aslong as the input and output of the methods remain the same.

The test suite should remain unchanged and should still pass after you are done refactoring.

1. Requirements
===============

You can run and develop this code on any environment that has access to the internet and runs PHP 5.3 and higher.

2. Configure the environment
============================

./composer.phar install

3. Execute the test suite
=========================

./vendor/bin/phpunit


This should run the unit test file where 4 tests and 10 assertions should pass.


4. Share results
================

Once you have finished and everything works, please upload the code to your GitHub profile and send us the link for review.