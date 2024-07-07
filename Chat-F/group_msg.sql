CREATE TABLE messages (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    sender_id INT(11) NOT NULL,
    receiver_id INT(11) DEFAULT NULL,
    group_id INT(11) DEFAULT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX (sender_id),
    INDEX (receiver_id),
    INDEX (group_id)
);
