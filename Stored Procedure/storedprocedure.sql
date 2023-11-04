BEGIN
  DECLARE user_count INT;
  SET p_login_result = 0;
  
  -- Sanitize inputs to prevent SQL injection
  SET p_username = TRIM(p_username);
  SET p_password = TRIM(p_password);
  
  -- Check if the provided username and password match
  SELECT COUNT(*) INTO user_count
  FROM users
  WHERE username = p_username AND password = p_password;
  
  IF user_count = 1 THEN
    SET p_login_result = 1; -- Login success
  END IF;
END