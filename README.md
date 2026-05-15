

## SOLID

### Single Responsibility Principle (SRP)
A class should have one, and only one, reason to change. This means that a class should only have one job or responsibility. If a class has more than one responsibility, it becomes coupled and changes to one responsibility may affect the other responsibilities.

### Open/Closed Principle (OCP)
Software entities (classes, modules, functions, etc.) should be open for extension but closed for modification. This means that the behavior of a module can be extended without modifying its source code. This is typically achieved through inheritance or interfaces.

### Liskov Substitution Principle (LSP)
Functions that use pointers or references to a base class must be able to use objects of any derived class without knowing it. This means that derived classes should be substitutable for their base classes. If a derived class cannot be used in place of its base class, then the design violates the LSP.

### Interface Segregation Principle (ISP)
Clients should not be forced to depend on interfaces they do not use. This means that a class should not be forced to implement interfaces it does not need. Instead, multiple smaller interfaces should be created to cater to the specific needs of different clients.

### Dependency Inversion Principle (DIP)
High-level modules should not depend on low-level modules. Both should depend on abstractions. This means that the design should depend on interfaces or abstract classes rather than concrete implementations. This allows for more flexible and maintainable code.
