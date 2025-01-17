import { useEffect, useState } from "react";
import classNames from "classnames/bind";
import ArrowBackIcon from "@mui/icons-material/ArrowBack";
import ArrowForwardIcon from "@mui/icons-material/ArrowForward";
import { Pagination, PaginationItem } from "@mui/material";
import { Add } from "@mui/icons-material";

import style from "./PersonnelManagement.module.scss";
import { getPaginationUsers } from "~/services/UserService";
import EnhancedTable from "~/components/EnhancedTable";
import CustomButton from "~/components/CustomButton";
import ModalAddUser from "~/components/ModalAddUser";

const cx = classNames.bind(style);

const headCells = [
    {
        id: "id",
        align: "center",
        disablePadding: false,
        label: "ID",
    },
    {
        id: "first_name",
        align: "left",
        disablePadding: false,
        label: "First name",
    },
    {
        id: "last_name",
        align: "left",
        disablePadding: false,
        label: "Last name",
    },

    {
        id: "email",
        align: "left",
        disablePadding: false,
        label: "Email",
    },
];

function PersonnelManagement() {
    const [listUsers, setListUsers] = useState([]);
    const [totalPage, setTotalPage] = useState(0);
    const [openModalAdd, setOpenModalAdd] = useState(false);

    useEffect(() => {
        getUsers();
    }, []);

    const getUsers = async (page = 1) => {
        let res = await getPaginationUsers(page);
        if (res && res.data) {
            setListUsers(res.data);
            setTotalPage(res.meta.last_page);
        }
    };

    const handleChangePagination = (event, value) => {
        getUsers(value);
    };

    const handleCloseModalAdd = () => {
        setOpenModalAdd(false);
    };

    return (
        <>
            <div className={`my-3 ${cx("container")}`}>
                <strong>Action:</strong>
                <div>
                    <CustomButton
                        title="Add new user"
                        variant="contained"
                        color="success"
                        size="medium"
                        startIcon={<Add />}
                        handleClick={() => {
                            setOpenModalAdd(true);
                        }}
                    />
                </div>
            </div>
            <EnhancedTable
                className="my-3"
                headCell={headCells}
                data={listUsers}
                title="List of employees"
            />
            <Pagination
                variant="outlined"
                count={totalPage}
                color="primary"
                showFirstButton
                showLastButton
                renderItem={(item) => (
                    <PaginationItem
                        slots={{
                            previous: ArrowBackIcon,
                            next: ArrowForwardIcon,
                        }}
                        {...item}
                    />
                )}
                onChange={handleChangePagination}
            />
            <ModalAddUser
                openModal={openModalAdd}
                handleCloseModal={handleCloseModalAdd}
            />
        </>
    );
}

export default PersonnelManagement;
