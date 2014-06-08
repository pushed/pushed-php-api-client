<?php

class Pushed_Error extends Exception {}
class Pushed_HttpError extends Pushed_Error {}

/**
 * The parameters passed to the API call are invalid or not provided when required
 */
class Pushed_ValidationError extends Pushed_Error {}

/**
 * The provided API key is not a valid Pushed API key
 */
class Pushed_Invalid_Key extends Pushed_Error {}

/**
 * The provided API key is not a valid Pushed API secret
 */
class Pushed_Invalid_Secret extends Pushed_Error {}

/**
 * The requested feature requires payment.
 */
class Pushed_PaymentRequired extends Pushed_Error {}

/**
 * The subsystem providing this API call is down for maintenance
 */
class Pushed_ServiceUnavailable extends Pushed_Error {}
