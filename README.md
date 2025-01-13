## **CRUD Project Management System Documentation**

### **Overview**  
The **CRUD Project Management System** is a web application designed to help administrators manage **projects**, **items**, and **team members** efficiently. The system provides a user-friendly interface to perform Create, Read, Update, and Delete (CRUD) operations on various data entities.

---

### **Features**  

#### **1. Projects Admin Page**  
   - **Add New Project:** Fill out a form to create new projects, specifying:
     - **Project Title:** Short name of the project.
     - **Description:** Detailed purpose and objectives.
     - **Team Members:** Assign team members to the project.
     - **Status:** Set the status as *To Do*, *In Progress*, or *Completed*.
   - **View All Projects:** Display a table of existing projects with details.
   - **Edit Project:** Modify project details.
   - **Delete Project:** Remove a project from the list.

#### **2. Items Admin Page**  
   - Manage inventory or resources related to projects.
   - Add, view, edit, and delete items.

#### **3. Members Admin Page**  
   - Add new team members.
   - View a list of all registered members.
   - Edit or remove members as needed.

---

### **User Interface**  
- **Navigation Buttons:**  
  - `Projects`, `Items`, and `Members` links are available for quick access to different sections.
- **Responsive Design:**  
  - The layout adapts to both desktop and mobile views.
- **Form Validation:**  
  - Ensures valid inputs (e.g., required fields and correct data formats).

---

### **Getting Started**

#### **1. Installation Instructions**  
   - **Clone the repository:**  
     ```bash
     git clone https://github.com/markneilcordero/crud-project-management-system.git
     cd crud-project-management-system
     ```

#### **2. Configuration**  
   - Set up the database:
     1. Import the provided SQL file into your MySQL server.
     2. Update the database connection details in the `config.php` or `.env` file (depending on your setup):
        ```php
        $host = 'localhost';
        $db = 'your_database_name';
        $user = 'your_username';
        $password = 'your_password';
        ```

#### **3. Run the Application**  
   - Open your browser and navigate to `http://localhost/crud-project-management-system` to access the application.

---

### **Dependencies**  
- **Frontend:** Bootstrap, jQuery for interactive UI components.  
- **Backend:** PHP for server-side processing.  
- **Database:** MySQL for storing project, item, and member data.

---

### **CRUD Operations Overview**  

| **Entity** | **Create** | **Read** | **Update** | **Delete** |
|-------------|------------|----------|------------|-----------|
| **Projects** | Add a new project using the form. | View all projects in a table. | Edit existing project details. | Delete projects from the table. |
| **Items**    | Add a new item. | View the item list. | Update item details. | Remove items from the list. |
| **Members**  | Add team members. | View all members. | Edit member details. | Delete members from the team. |

---

### **Sample Usage**

#### **Adding a New Project:**  
1. Navigate to the **Projects Admin Page**.
2. Fill out the form:
   - **Title:** Example: *Project Alpha*.
   - **Description:** Example: *Increase team productivity*.
   - **Team Members:** Select from the drop-down.
   - **Status:** Choose *To Do*, *In Progress*, or *Completed*.
3. Click **Save** to add the project.

#### **Editing or Deleting a Project:**  
- Click **Edit** to update project information.  
- Click **Delete** to remove the project from the list.

---

### **Next Steps and Enhancements**  
- Add user authentication for secure access.  
- Implement a **search bar** for faster navigation within tables.  
- Add **filters** to view projects based on status or assigned team members.  
- Include **export/import features** to backup or restore project data.

---

This documentation provides a comprehensive guide to using the **CRUD Project Management System**.
