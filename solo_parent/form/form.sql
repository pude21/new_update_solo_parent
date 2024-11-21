-- Create the registrations table
CREATE TABLE registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT,
    sex ENUM('Male', 'Female', 'Other'),
    status VARCHAR(50),
    date_of_birth DATE,
    place_of_birth VARCHAR(100),
    home_address VARCHAR(255),
    occupation VARCHAR(100),
    religion VARCHAR(50),
    contact_no VARCHAR(15),
    pantawid VARCHAR(50),
    elementary VARCHAR(100),
    high_school VARCHAR(100),
    vocational VARCHAR(100),
    college VARCHAR(100),
    others VARCHAR(100),
    school VARCHAR(100),
    civic VARCHAR(100),
    community VARCHAR(100),
    workplace VARCHAR(100)
    
);

-- Sample insert into registrations table


-- Create the family_members table
CREATE TABLE family_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    relationship VARCHAR(50) NOT NULL,
    age INT,
    birthday DATE,
    occupation VARCHAR(100),
    FOREIGN KEY (user_id) REFERENCES registrations(id) ON DELETE CASCADE
);
CREATE TABLE seminars_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    date date NOT NULL,
    organizer varchar(50) not null,
    
    FOREIGN KEY (user_id) REFERENCES registrations(id) ON DELETE CASCADE
);
