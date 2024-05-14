import { Link } from 'react-router-dom';

const Button = ({ location = '', classname = '', onClick = () => {}, children = 'Button' }) => {
  return (
    <Link
      to={location}
      className={`flex items-center justify-center text-lg font-semibold py-3 px-[35px] btn-1 ${classname}`}
      onClick={onClick}
    >
      {children}
    </Link>
  );
};

export default Button;
