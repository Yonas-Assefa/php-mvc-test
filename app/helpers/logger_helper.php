<?php
/**
 * Helper functions for logging
 */

/**
 * Get the global logger instance
 * 
 * @return Logger The global logger instance
 */
function logger() {
    return $GLOBALS['logger'];
}

/**
 * Log a message with the specified level
 * 
 * @param string $level Log level
 * @param string $message Message to log
 * @param array $context Additional context data
 * @return bool Whether the log was written successfully
 */
function log_message($level, $message, array $context = []) {
    return logger()->log($level, $message, $context);
}

/**
 * Log an info message
 * 
 * @param string $message Message to log
 * @param array $context Additional context data
 * @return bool Whether the log was written successfully
 */
function log_info($message, array $context = []) {
    return logger()->info($message, $context);
}

/**
 * Log an error message
 * 
 * @param string $message Message to log
 * @param array $context Additional context data
 * @return bool Whether the log was written successfully
 */
function log_error($message, array $context = []) {
    return logger()->error($message, $context);
}

/**
 * Log a debug message
 * 
 * @param string $message Message to log
 * @param array $context Additional context data
 * @return bool Whether the log was written successfully
 */
function log_debug($message, array $context = []) {
    return logger()->debug($message, $context);
}

/**
 * Log a warning message
 * 
 * @param string $message Message to log
 * @param array $context Additional context data
 * @return bool Whether the log was written successfully
 */
function log_warning($message, array $context = []) {
    return logger()->warning($message, $context);
} 