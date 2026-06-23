# Project Documentation: Eagles Secondary School Parent Assistance Chatbot (EduBot)

## 1. Project Title
**Project Name:** EduBot: The Eagles Secondary School Parent Assistance Chatbot
**Description:** A responsive, web-based automated assistant designed to provide instant support to parents regarding school admissions, fees, academic calendars, and general inquiries.

---

## 2. Problem Statement
Eagles Secondary School currently faces significant challenges in managing communication with parents. The existing manual system for handling inquiries is plagued by:
- **Delayed Responses:** Parents often wait hours or days for simple information via email or phone.
- **Resource Inefficiency:** Administrative staff spend a disproportionate amount of time answering the same repetitive questions.
- **Limited Accessibility:** Support is only available during school office hours (8:00 AM – 3:30 PM), leaving parents without assistance during evenings or weekends.
- **Information Inconsistency:** Manual handling can lead to conflicting information being given by different staff members.

---

## 3. Background of the School
Eagles Secondary School is a premier educational institution known for its academic rigor and holistic development programs. Located at 123 Education Avenue, the school serves over 1,200 students across various grades. As the school has grown, so has the demand for streamlined communication between the administration and the parent community. The school prides itself on innovation but has lagged in automating its external communication channels.

---

## 4. Current Manual System
The current system for parent assistance is entirely manual:
1. **Physical Visits:** Parents must travel to the school for inquiries, which is time-consuming.
2. **Phone Calls:** The school reception handles a high volume of calls, often resulting in busy lines.
3. **Email Inquiries:** Staff manually sort and respond to emails, a process that is prone to delays.
4. **Manual Records:** Inquiry logs (if any) are kept in physical ledgers or simple spreadsheets, making it difficult to track common concerns or improve service.

---

## 5. Effects of the Problem (Stakeholder Impact)

| Stakeholder | Effect of Problem | Impact Level |
| :--- | :--- | :--- |
| **Parents** | High frustration due to long wait times and limited access to information. | **High** |
| **Administrative Staff** | Burnout and decreased productivity due to repetitive manual tasks. | **High** |
| **School Management** | Poor institutional image and potential loss of prospective admissions. | **Medium** |
| **Students** | Indirect impact through delayed administrative processes (e.g., fee confirmation). | **Low** |

---

## 6. Proposed Solution
The proposed solution is **EduBot**, an intelligent, web-based chatbot system.
- **24/7 Availability:** Provides instant answers at any time of day.
- **Automated FAQ Resolution:** Uses a keyword-matching algorithm to answer common questions from a pre-defined database.
- **Admin Control:** A secure dashboard allows school administrators to update the knowledge base in real-time.
- **Seamless Integration:** A floating widget on the existing school website ensures ease of access.

---

## 7. Software Requirements Specification (SRS)

### 7.1 Introduction
The purpose of this document is to outline the requirements for the EduBot system. It serves as a guide for developers and a reference for stakeholders to ensure all business needs are met.

### 7.2 Scope
The system will handle:
- Automated responses to general school inquiries.
- An administrative interface for content management.
- User session handling for administrators.
- Responsive UI for mobile and desktop users.

### 7.3 Overall Description
EduBot is a lightweight PHP/MySQL application. It consists of a frontend chat interface and a backend administrative portal. It does not require complex AI training but relies on a robust database of Frequently Asked Questions (FAQs).

### 7.4 Use Cases
- **UC-01: Query FAQ:** A parent types a question; the system searches the database and returns the most relevant answer.
- **UC-02: Manage Knowledge Base:** An admin logs in to add, edit, or delete FAQ entries.
- **UC-03: Fallback Support:** If no match is found, the system provides contact details for human assistance.

### 7.5 Functional Requirements
1. **Search Engine:** The system must parse user input and match it against the `faq` table using keyword detection.
2. **Admin Authentication:** The system must restrict dashboard access to authorized users via a secure login.
3. **CRUD Operations:** Admins must be able to Create, Read, Update, and Delete FAQs.
4. **Typing Simulation:** The chat UI should show a "typing..." indicator to enhance user experience.

### 7.6 Non-Functional Requirements
1. **Performance:** Responses must be delivered in under 2 seconds.
2. **Security:** All admin passwords must be hashed. SQL queries must be protected against injection.
3. **Usability:** The interface must be intuitive, requiring no training for parents to use.
4. **Responsiveness:** The system must function perfectly on Chrome, Safari, and Firefox across mobile and desktop.

---

## 8. Conclusion
The implementation of the EduBot system will transform how Eagles Secondary School interacts with its community. By automating the majority of parent inquiries, the school will see a significant increase in administrative efficiency and parent satisfaction. This project represents a critical step in the school’s digital transformation journey.
