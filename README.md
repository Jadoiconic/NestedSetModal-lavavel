<h2>Documentation</h2>

<p>
Project Description: RESTful API for Managing Categories in an Online Store

The goal of this project is to create a RESTful API using Laravel for managing categories in an online store. The API will allow users to perform CRUD (Create, Read, Update, Delete) operations on categories using the nested set model. Categories will be stored in a MySQL database, and the API will return responses in XML format.

Key Features:

<ul>
<li>
<b>Database</b>: The project requires a MySQL database named "online_store" with a "categories" table, which includes columns such as id, name, lft (left bound), rgt (right bound), created_at, and updated_at. The nested set model provided by the "kalnoy/nestedset" package will be used to manage hierarchical relationships between categories.
</li>
<li>
<b>API Endpoints:</b>
<u>GET /api/category</u>: Retrieves all categories in XML format.<br>
<u>GET /api/category/{id}</u>: Retrieves a specific category by its ID in XML format.<br>
<u>POST /api/category</u>: Creates a new category. Accepts XML request payload with name and parent_id fields. Returns the created category in XML format.<br>
<u>PUT /category/{id}</u>: Updates an existing category by its ID. Accepts XML request payload with name field. Returns the updated category in XML format.<br>
<u>DELETE /category/{id}</u>: Deletes a category by its ID. Returns a success message in XML format.
</li>
<li>
XML Response Format: The API responses will be in XML format, ensuring compatibility with XML-based systems or clients.
</li>
<li>
Error Handling and Validation: The API endpoints will have appropriate error handling and validation to ensure data integrity and provide meaningful error responses in XML format for invalid requests.
</li>
<li>
Sample Categories: The project includes functionality to create sample categories in the database for testing purposes.
</li>
</ul>

</p>

<p>
By implementing this API, users will be able to perform category management operations efficiently and seamlessly integrate the API with their online store or any XML-based systems.
</p>