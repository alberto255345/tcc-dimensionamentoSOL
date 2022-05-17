CREATE USER 'tcc_albert'@'172.27.0.0/16' IDENTIFIED BY '';
CREATE USER 'tcc_albert'@'localhost' IDENTIFIED BY '';
GRANT ALL PRIVILEGES ON *.* TO 'tcc_albert'@'localhost';
GRANT ALL PRIVILEGES ON *.* TO 'tcc_albert'@'172.27.0.0/16';
FLUSH PRIVILEGES;