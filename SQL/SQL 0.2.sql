INSERT INTO User (uid, Name, Email, PhoneNumber, Address, password, github_link, date_of_birth)
VALUES
  (1, 'John Doe', 'john@example.com', 1234567890, '123 Main St, City', 'password123', 'github.com/johndoe', '1990-01-01'),
  (2, 'Jane Smith', 'jane@example.com', 9876543210, '456 Park Ave, Town', 'hello123', 'github.com/janesmith', '1985-05-15'),
  (3, 'Bob Johnson', 'bob@example.com', 5555555555, '789 Broad Rd, Village', 'secretword', 'github.com/bobjohnson', '1995-09-30');

SELECT * FROM User;
SELECT * FROM Discussion;