INSERT INTO User (uid, Name, Email, PhoneNumber, Address, password, github_link, date_of_birth)
VALUES
  (1, 'John Doe', 'john@example.com', 1234567890, '123 Main St, City', 'password123', 'github.com/johndoe', '1990-01-01'),
  (2, 'Jane Smith', 'jane@example.com', 9876543210, '456 Park Ave, Town', 'hello123', 'github.com/janesmith', '1985-05-15'),
  (3, 'Bob Johnson', 'bob@example.com', 5555555555, '789 Broad Rd, Village', 'secretword', 'github.com/bobjohnson', '1995-09-30');

INSERT INTO Discussion (discussion_id, uid, code_post, description_post)
VALUES
  (101, 1, 'print("Hello, world!")', 'This is a simple Python code to print Hello, world!'),
  (102, 2, 'SELECT * FROM users;', "I'm having trouble with this SQL query, can someone help?"),
  (103, 3, 'function add(a, b) { return a + b; }', 'A JavaScript function to add two numbers.');

INSERT INTO Geek (discussion_id, geeker_uid)
VALUES
  (101, 2),
  (101, 3),
  (102, 1),
  (103, 2);

INSERT INTO Comments (discussion_id, uid, comment_content)
VALUES
  (101, 3, 'Great code!'),
  (101, 1, 'I made some improvements.'),
  (102, 3, 'Try using a JOIN instead.'),
  (103, 1, 'Your function works perfectly!');

