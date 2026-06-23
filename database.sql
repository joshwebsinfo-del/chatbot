CREATE DATABASE IF NOT EXISTS school_chatbot;
USE school_chatbot;

CREATE TABLE IF NOT EXISTS faq (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    answer TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Insert sample FAQs
INSERT INTO faq (question, answer) VALUES
('What are the school fees?', 'Please contact the accounts office at accounts@eagles.edu.'),
('How do I apply?', 'Visit the school office or download the admission form online from our Admissions page.'),
('What are school hours?', 'School runs from 8:00 AM to 3:00 PM, Monday to Friday.'),
('Where is the school located?', 'We are located at 123 Education Avenue, NY.'),
('What subjects do you offer?', 'We offer a wide range of subjects including Mathematics, English, Sciences, Arts, and Computer Studies.'),
('Do you provide transport or buses?', 'Yes, we have a fleet of school buses covering major routes. Please contact the transport office for routes and fees.'),
('What is the school uniform?', 'Boys wear white shirts with navy blue trousers. Girls wear white blouses with navy blue skirts. The sports uniform is a yellow t-shirt.'),
('When does the new term start?', 'The next academic term usually begins in early September. Please check the school calendar for exact dates.'),
('Are there any clubs or extracurricular activities?', 'Yes! We have various clubs including Debate, Chess, Drama, and sports teams for football, basketball, and athletics.'),
('How can I contact the principal?', 'You can book an appointment with the principal through the main reception or call our office number.'),
('Do you have boarding facilities or hostels?', 'Yes, we offer both day and boarding facilities for students with separate, secure hostels for boys and girls.');

-- Default admin: admin / password
INSERT INTO admin (username, password) VALUES
('admin', '$2y$10$e8wF1XjD1h40sR0I/MofHuc9f2P40I0F5nS/6/wR9n/zN23uG01G6');
