CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    semester VARCHAR(255) NOT NULL,
    course_code VARCHAR(255) NOT NULL,
    coordinator_id INT NOT NULL,
    FOREIGN KEY (coordinator_id) REFERENCES users(id)
);

CREATE TABLE project_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT NOT NULL,
    student_id INT NOT NULL,
    FOREIGN KEY (project_id) REFERENCES projects(id),
    FOREIGN KEY (student_id) REFERENCES users(id),
    UNIQUE (project_id, student_id)
);
