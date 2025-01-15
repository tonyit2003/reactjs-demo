import { useEffect, useState } from "react";
import { Table } from "react-bootstrap";
import { getPaginationUsers } from "~/services/UserService";

function PersonnelManagement() {
    const [listUsers, setListUsers] = useState([]);
    useEffect(() => {
        getUsers();
    }, []);

    const getUsers = async () => {
        let res = await getPaginationUsers();
        if (res && res.data) {
            setListUsers(res.data);
        }
    };

    return (
        <div>
            <Table striped bordered hover>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    {listUsers &&
                        listUsers.length > 0 &&
                        listUsers.map((user, index) => {
                            return (
                                <tr key={`users-${index}`}>
                                    <td>{user.id}</td>
                                    <td>{user.first_name}</td>
                                    <td>{user.last_name}</td>
                                    <td>{user.email}</td>
                                </tr>
                            );
                        })}
                </tbody>
            </Table>
        </div>
    );
}

export default PersonnelManagement;
