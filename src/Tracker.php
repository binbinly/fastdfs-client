<?php

declare(strict_types=1);

/*
 * This file is part of eelly package.
 *
 * (c) eelly.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eelly\FastDFS;

/**
 * Tracker.
 */
class Tracker extends Base
{
    /**
     * 根据GroupName申请Storage地址
     *
     * @command 104
     *
     * @param string $group_name 组名称
     *
     * @return array/boolean
     */
    public function applyStorage($group_name)
    {
        $req_header = self::buildHeader(104, Base::GROUP_NAME_MAX_LEN);
        $req_body = self::padding($group_name, Base::GROUP_NAME_MAX_LEN);

        $this->send($req_header.$req_body);

        $res_header = $this->read(Base::HEADER_LENGTH);
        $res_info = self::parseHeader($res_header);

        if (0 !== $res_info['status']) {
            throw new Exception(
                'something wrong with get storage by group name',
                $res_info['status']);

            return false;
        }

        $res_body = (bool) $res_info['length']
            ? $this->read($res_info['length'])
            : '';

        $group_name = trim(substr($res_body, 0, Base::GROUP_NAME_MAX_LEN));
        $storage_addr = trim(substr($res_body, Base::GROUP_NAME_MAX_LEN,
            Base::IP_ADDRESS_SIZE - 1));

        list(, , $storage_port) = unpack('N2', substr($res_body,
            Base::GROUP_NAME_MAX_LEN + Base::IP_ADDRESS_SIZE - 1,
            Base::PROTO_PKG_LEN_SIZE));

        $storage_index = \ord(substr($res_body, -1));

        return [
            'group_name'    => $group_name,
            'storage_addr'  => $storage_addr,
            'storage_port'  => $storage_port,
            'storage_index' => $storage_index,
        ];
    }
}
