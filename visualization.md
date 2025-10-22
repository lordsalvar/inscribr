```
+-----------------------+          Read-only API           +--------------------------------+
|    Clock Work (DTR)   | -------------------------------> |  Inscribr (Registration & A/A) |
+-----------------------+                                   +--------------------------------+
| - Employees (uid)     |                                   | - Employees (uid, registration)|
| - Scanners (uid)      |                                   | - Enrollment (Emp ↔ Scanner)   |
| - Offices (code)      |                                   | - Deployment (Emp ↔ Office)    |
| - Groups              |                                   | - Member (Emp ↔ Group)         |
| - Timelogs            |                                   | - Assignments (User ↔ Assign.) |
+-----------------------+                                   | - Users (app accounts)         |
                                                            +--------------------------------+

Key identifiers shared between systems:
- Employee uid, Office code, Scanner uid, Group id

Operational flow:
1) Inscribr registers employee (stores registration metadata, keyed by uid)
2) Inscribr enrolls employee to scanner(s) (Enrollment)
3) Inscribr deploys employee to office (Deployment)
4) Inscribr manages group membership (Member)
5) Optional: Inscribr assigns app users to resources (Assignments)

DTR ownership:
- Scanners (in Clock Work) generate Timelogs (attendance stays in Clock Work)
- Inscribr never writes to Clock Work; it reads via API and writes only to its own DB

Data access for consumers:
- Inscribr exposes read-only endpoints that combine local history (enroll/deploy/member) with Clock Work lookups
```


#document creation module

---
# Signing Module
## Using PyHanko
Must have repository of p12s for each users
```mermaid

```
signatures
- specimen
- certificate
- fk user

### Signing
must use python script called via processes in laravel 
### using ai we should be able to snipe the signature fields of the specific user via their name 