import { Container, Row } from "react-bootstrap";
import Header from "~/components/Header";

function AdminLayout({ children }) {
    return (
        <>
            <Header />
            <Container>
                <div>{children}</div>
            </Container>
        </>
    );
}

export default AdminLayout;
