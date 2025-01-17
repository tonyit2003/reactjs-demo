import {
    Dialog,
    DialogActions,
    DialogContent,
    DialogContentText,
    DialogTitle,
} from "@mui/material";
import { Button } from "react-bootstrap";
import PropTypes from "prop-types";

function ModalAddUser({ openModal = false, handleCloseModal }) {
    return (
        <>
            <Dialog
                open={openModal}
                onClose={handleCloseModal}
                aria-labelledby="alert-dialog-title"
                aria-describedby="alert-dialog-description"
            >
                <DialogTitle id="alert-dialog-title">
                    <strong>Add new user</strong>
                </DialogTitle>
                <DialogContent>
                    <DialogContentText id="alert-dialog-description">
                        Let Google help apps determine location. This means
                        sending anonymous location data to Google, even when no
                        apps are running.
                    </DialogContentText>
                </DialogContent>
                <DialogActions>
                    <Button onClick={handleCloseModal} autoFocus>
                        Agree
                    </Button>
                </DialogActions>
            </Dialog>
        </>
    );
}

ModalAddUser.propTypes = {
    openModal: PropTypes.bool,
    handleCloseModal: PropTypes.func.isRequired,
};

export default ModalAddUser;
