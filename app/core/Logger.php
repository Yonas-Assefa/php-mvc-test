<?php
/**
 * Logger class for industry-standard application logging
 * 
 * Provides PSR-3 inspired logging functionality with file rotation
 */
class Logger {
    // Log levels based on PSR-3 standard
    const EMERGENCY = 'emergency';
    const ALERT     = 'alert';
    const CRITICAL  = 'critical';
    const ERROR     = 'error';
    const WARNING   = 'warning';
    const NOTICE    = 'notice';
    const INFO      = 'info';
    const DEBUG     = 'debug';
    
    // Default log file
    private $logFile;
    
    // Max log file size in bytes (5MB default)
    private $maxFileSize = 5242880;
    
    // Minimum log level that will be recorded
    private $minimumLevel = self::INFO;
    
    /**
     * Constructor
     * 
     * @param string $logFile Path to log file
     * @param string $minimumLevel Minimum log level to record
     */
    public function __construct($logFile = null, $minimumLevel = null) {
        // Set log file path
        if ($logFile === null) {
            $this->logFile = APPROOT . '/logs/app.log';
        } else {
            $this->logFile = $logFile;
        }
        
        // Set minimum logging level if provided
        if ($minimumLevel !== null) {
            $this->minimumLevel = $minimumLevel;
        }
        
        // Ensure log directory exists
        $logDir = dirname($this->logFile);
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
    }
    
    /**
     * Log a message at the specified level
     * 
     * @param string $level Log level
     * @param string $message Message to log
     * @param array $context Additional context data
     * @return bool Whether the log was written successfully
     */
    public function log($level, $message, array $context = []) {
        // Check if we should log this level
        if (!$this->shouldLog($level)) {
            return false;
        }
        
        // Rotate log file if needed
        $this->rotateLogFile();
        
        // Format the log message
        $logMessage = $this->formatLogMessage($level, $message, $context);
        
        // Write to log file
        return file_put_contents($this->logFile, $logMessage, FILE_APPEND) !== false;
    }
    
    /**
     * Determine if the current log level should be recorded
     * 
     * @param string $level Log level to check
     * @return bool Whether the level should be logged
     */
    private function shouldLog($level) {
        $levels = [
            self::DEBUG => 0,
            self::INFO => 1,
            self::NOTICE => 2,
            self::WARNING => 3,
            self::ERROR => 4,
            self::CRITICAL => 5,
            self::ALERT => 6,
            self::EMERGENCY => 7
        ];
        
        // If level doesn't exist, default to logging it
        if (!isset($levels[$level]) || !isset($levels[$this->minimumLevel])) {
            return true;
        }
        
        // Log only if level is higher than or equal to minimum level
        return $levels[$level] >= $levels[$this->minimumLevel];
    }
    
    /**
     * Format a log message with timestamp, level, message and context
     * 
     * @param string $level Log level
     * @param string $message Log message
     * @param array $context Additional context data
     * @return string Formatted log message
     */
    private function formatLogMessage($level, $message, array $context = []) {
        // Format timestamp
        $timestamp = date('Y-m-d H:i:s');
        
        // Format context data
        $contextStr = empty($context) ? '' : ' ' . json_encode($context);
        
        // Get IP address and request URI if available
        $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '-';
        $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '-';
        
        // Format: [2025-05-15 02:25:47] [INFO] [127.0.0.1] [/path?query] Message {"context":"data"}
        return sprintf(
            "[%s] [%s] [%s] [%s] %s%s\n",
            $timestamp,
            strtoupper($level),
            $ip,
            $uri,
            $message,
            $contextStr
        );
    }
    
    /**
     * Rotate log file if it exceeds max size
     */
    private function rotateLogFile() {
        // Check if file exists and is larger than max size
        if (file_exists($this->logFile) && filesize($this->logFile) > $this->maxFileSize) {
            // Create archive filename with timestamp
            $archiveFile = $this->logFile . '.' . date('Y-m-d-H-i-s') . '.bak';
            
            // Rename current log to archive
            rename($this->logFile, $archiveFile);
        }
    }
    
    /**
     * Log methods for different levels
     */
    public function emergency($message, array $context = []) {
        return $this->log(self::EMERGENCY, $message, $context);
    }
    
    public function alert($message, array $context = []) {
        return $this->log(self::ALERT, $message, $context);
    }
    
    public function critical($message, array $context = []) {
        return $this->log(self::CRITICAL, $message, $context);
    }
    
    public function error($message, array $context = []) {
        return $this->log(self::ERROR, $message, $context);
    }
    
    public function warning($message, array $context = []) {
        return $this->log(self::WARNING, $message, $context);
    }
    
    public function notice($message, array $context = []) {
        return $this->log(self::NOTICE, $message, $context);
    }
    
    public function info($message, array $context = []) {
        return $this->log(self::INFO, $message, $context);
    }
    
    public function debug($message, array $context = []) {
        return $this->log(self::DEBUG, $message, $context);
    }
} 