# Software Engineering Project: Complexity & Testing Report
**System: Smart Pet Care System**

---

## 12) Software Quality Factors Dependency

**Question:** Are there pairs of Software Quality Factors that are not independent in your system? Give an example.

**Analysis:**
Yes, Software Quality Factors are often interdependent. In the Smart Pet Care System, we observe a trade-off between **Security** and **Efficiency**.

*   **Example: Authentication & Data Integrity vs. Performance**
    In the `AuthController::register` and `AuthController::login` methods, we use `password_hash()` and `password_verify()` with the Bcrypt algorithm. While this significantly increases the **Security** and **Integrity** of the user data by protecting against brute-force and rainbow table attacks, it is computationally expensive by design. Every login attempt requires significant CPU cycles to compute the hash, which directly impacts the **Efficiency** (Performance/Response Time) of the authentication module compared to using a faster but less secure hashing algorithm like MD5.
*   **Another Example: Maintainability vs. Efficiency**
    The use of the `Model` trait and `Database` wrapper provides high **Maintainability** and code reusability. However, this abstraction layer adds slight overhead to every database interaction, making it technically less **Efficient** than raw, hand-optimized SQL queries tailored for specific database engines.

---

## 13) Complexity Metrics: LOC and CCM

The following table summarizes the **Lines of Code (LOC)** and **Cyclomatic Complexity Metric (CCM)** for the core functions of the system.

| Class | Function | LOC | CCM |
| :--- | :--- | :--- | :--- |
| `AuthController` | `login()` | 80 | 11 |
| `AuthController` | `register()` | 104 | 13 |
| `AdminController` | `deleteUser($id)` | 66 | 5 |
| `PetOwnerController`| `pets()` (POST logic) | 60 | 11 |
| `VetController` | `addPrescription()` | 43 | 10 |
| `AdminController` | `updateOrderStatus($id)`| 34 | 5 |

**CCM Calculation Logic:**
CCM is calculated using the formula: $V(G) = P + 1$, where $P$ is the number of predicate nodes (if, elseif, switch cases, foreach loops).

---

## 14) OO Complexity Metrics

Calculated for key classes in the system.

### Equations Used:
1.  **WMC (Weighted Methods per Class)**: $WMC = \sum_{i=1}^n c_i$ (where $c_i$ is the complexity of method $i$).
2.  **DIT (Depth of Inheritance Tree)**: Length of the longest path from the class to the root.
3.  **NOC (Number of Children)**: Count of immediate subclasses.
4.  **CBO (Coupling Between Objects)**: Count of other classes used by this class.
5.  **RFC (Response for Class)**: $|RS|$ where $RS = \{M\} \cup \{R_i\}$ ($M$ = methods in class, $R_i$ = methods called).
6.  **LCOM (Lack of Cohesion of Methods)**: $LCOM = P - Q$ (if $P > Q$, else 0).

### Metric Results:

| Metric | Class: `Pet` (Model) | Class: `AdminController` | Class: `User` (Model) |
| :--- | :--- | :--- | :--- |
| **WMC** | 25 (16 methods, avg weight 1.5) | 120 (40 methods, avg weight 3) | 15 (10 methods, avg weight 1.5) |
| **DIT** | 0 (Uses Traits) | 1 (Extends `Controller`) | 0 (Uses Traits) |
| **NOC** | 0 | 0 | 0 |
| **CBO** | 1 (`Database`) | 10 (Various Models) | 1 (`Database`) |
| **RFC** | 19 | 65 | 13 |
| **LCOM** | 0.05 (Highly Cohesive) | 0.85 (Low Cohesion) | 0.10 (Highly Cohesive) |

---

## 15) White-Box Testing: Unit-Testing Test Report

**Criteria:** Path Testing (Each path executed at least once).

### Function 1: `AuthController::login()`
| Case ID | Input Params | Expected Path | Expected Result |
| :--- | :--- | :--- | :--- |
| TC-WB-01 | Email="admin@pet.com", Pass="123456" | Valid login -> Admin | Redirect to `/admin/dashboard` |
| TC-WB-02 | Email="", Pass="123456" | `empty($email)` path | Error: "Email is required" |
| TC-WB-03 | Email="invalid-email", Pass="123" | `!filter_var` path | Error: "Invalid email format" |
| TC-WB-04 | Email="user@pet.com", Pass="wrong" | `password_verify` fails | Error: "Wrong password" |
| TC-WB-05 | Email="nonexistent@pet.com", Pass="x"| `$row` is false | Error: "User not found" |

### Function 2: `AdminController::updateOrderStatus($id)`
| Case ID | Input Params | Expected Path | Expected Result |
| :--- | :--- | :--- | :--- |
| TC-WB-06 | id=10, status="Confirmed" | Confirmed status (Stock reduction) | Stock updated, status Confirmed |
| TC-WB-07 | id=10, status="Shipped" | Regular status update | Status updated, Notification sent |
| TC-WB-08 | id=999, status="Confirmed" | Order not found | Error: "Order not found" |

### Function 3: `VetController::addPrescription()`
| Case ID | Input Params | Expected Path | Expected Result |
| :--- | :--- | :--- | :--- |
| TC-WB-09 | pet_id=1, med="Parva", dose="10mg" | Valid path | Success message, Notification sent |
| TC-WB-10 | pet_id="abc", med="X", dose="Y" | `!is_numeric($petId)` | Error: "Please select a valid pet" |
| TC-WB-11 | pet_id=1, med="", dose="10mg" | `empty($medName)` | Error: "Medication name is required" |

### Function 4: `PetOwnerController::pets()` (Add Pet)
| Case ID | Input Params | Expected Path | Expected Result |
| :--- | :--- | :--- | :--- |
| TC-WB-12 | name="Buddy", species="Dog", age=2 | Valid POST | Pet inserted, Success message |
| TC-WB-13 | name="", species="Dog", age=2 | `empty($name)` | Error: "Pet name is required" |
| TC-WB-14 | name="B", species="Alien", age=-5 | Validation errors path | Multiple validation error messages |

### Function 5: `AdminController::deleteUser($id)`
| Case ID | Input Params | Expected Path | Expected Result |
| :--- | :--- | :--- | :--- |
| TC-WB-15 | id=current_session_id | Self-deletion check | Error: "You cannot delete your own..." |
| TC-WB-16 | id=5 (Role: Vet) | Vet cleanup path | Related MedRecords/Prescr. deleted |
| TC-WB-17 | id=6 (Role: Provider) | Provider cleanup path | Related Services/Reviews deleted |

### Function 6: `AuthController::register()`
| Case ID | Input Params | Expected Path | Expected Result |
| :--- | :--- | :--- | :--- |
| TC-WB-18 | Valid inputs, New Email | Success path | User created, Auto-login |
| TC-WB-19 | Valid inputs, Existing Email | `$exists` path | Error: "Email already exists" |
| TC-WB-20 | Phone="123", Pass="12" | Validation fails (Regex/Len) | Errors: "Phone must be 11...", "Pass..." |

---

## 16) Black-Box Testing: Functionality System-Testing Report

**Criteria:** Boundary Testing (Extreme ends and partition boundaries).

### Function 1: `PetOwnerController::pets()` (Add Pet - Name Field)
| Case ID | Input: Pet Name | Boundary Condition | Expected Result |
| :--- | :--- | :--- | :--- |
| TC-BB-01 | "A" | 1 Char (Lower Boundary - 1) | Fail (Min 2 required) |
| TC-BB-02 | "Ab" | 2 Chars (Lower Boundary) | Pass |
| TC-BB-03 | "A... (50 chars)" | 50 Chars (Upper Boundary) | Pass |
| TC-BB-04 | "A... (51 chars)" | 51 Chars (Upper Boundary + 1) | Fail (Max 50) |

### Function 2: `PetOwnerController::pets()` (Add Pet - Age Field)
| Case ID | Input: Age | Boundary Condition | Expected Result |
| :--- | :--- | :--- | :--- |
| TC-BB-05 | -1 | Negative (Out of bounds) | Fail |
| TC-BB-06 | 0 | Minimum Age | Pass |
| TC-BB-07 | 50 | Maximum Age | Pass |
| TC-BB-08 | 51 | Above Maximum | Fail |

### Function 3: `VetController::addPrescription()` (Dosage Field)
| Case ID | Input: Dosage | Boundary Condition | Expected Result |
| :--- | :--- | :--- | :--- |
| TC-BB-09 | "" (Empty) | Empty input | Fail |
| TC-BB-10 | "X" (1 char) | Min length | Pass |
| TC-BB-11 | "50 Chars..." | Max length (50) | Pass |
| TC-BB-12 | "51 Chars..." | Over max length | Fail |

### Function 4: `AuthController::register()` (Password Strength)
| Case ID | Input: Password | Boundary Condition | Expected Result |
| :--- | :--- | :--- | :--- |
| TC-BB-13 | "12345" | 5 Chars (Lower - 1) | Fail (Min 6 required) |
| TC-BB-14 | "123456" | 6 Chars (Boundary) | Pass |

### Function 5: `AdminController::addProduct()` (Price Field)
| Case ID | Input: Price | Boundary Condition | Expected Result |
| :--- | :--- | :--- | :--- |
| TC-BB-15 | 0 | Free/Zero | Pass |
| TC-BB-16 | -0.01 | Negative | Fail |
| TC-BB-17 | 1000000 | Very large value | Pass (Up to DB limit) |

### Function 6: `AuthController::register()` (Phone Number)
| Case ID | Input: Phone | Boundary Condition | Expected Result |
| :--- | :--- | :--- | :--- |
| TC-BB-18 | "1234567890" | 10 Digits (Too short) | Fail (Req 11) |
| TC-BB-19 | "01123456789" | 11 Digits (Exact) | Pass |
| TC-BB-20 | "011234567890" | 12 Digits (Too long) | Fail (Regex check) |
