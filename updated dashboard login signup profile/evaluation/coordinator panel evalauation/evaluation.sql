
-- Create the student_marks table
CREATE TABLE IF NOT EXISTS student_marks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    project_id INT NOT NULL,
    attendance INT DEFAULT 0,
    guide_marks INT DEFAULT 0,
    presentation_marks INT DEFAULT 0,
    implementation_marks INT DEFAULT 0,
    total_review_marks INT DEFAULT 0,
    guide_evaluation_marks INT DEFAULT 0,
    project_report_marks INT DEFAULT 0,
    total_cie_marks INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
);
CREATE TABLE guide_marks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    project_id INT NOT NULL,
    guide_marks INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES users(id),
    FOREIGN KEY (project_id) REFERENCES projects(id)
);
