import { Button } from "@mui/material";
import PropTypes from "prop-types";

function CustomButton({
    title = "",
    variant = "contained",
    color = "success",
    size = "medium",
    startIcon,
    endIcon,
    disabled = false,
    loading = false,
    href,
    handleClick,
}) {
    return (
        <Button
            onClick={handleClick}
            href={href}
            variant={variant}
            color={color}
            size={size}
            startIcon={startIcon}
            endIcon={endIcon}
            disabled={disabled}
            loading={loading}
        >
            {title}
        </Button>
    );
}

CustomButton.propTypes = {
    title: PropTypes.string,
    variant: PropTypes.oneOf(["text", "contained", "outlined"]),
    color: PropTypes.string,
    size: PropTypes.oneOf(["small", "medium", "large"]),
    startIcon: PropTypes.node,
    endIcon: PropTypes.node,
    disabled: PropTypes.bool,
    loading: PropTypes.bool,
    href: PropTypes.string,
    handleClick: PropTypes.func,
};

export default CustomButton;
